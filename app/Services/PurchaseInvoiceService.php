<?php

namespace App\Services;

use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceItem;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceService
{
    public function __construct(
        private readonly TreasuryService $treasuryService
    ) {}

    /**
     * Create a complete purchase invoice atomically.
     * Mirrors Android buyinvoice save flow:
     *   1. Insert buy_invoices_table record
     *   2. Insert buyproducts_table rows
     *   3. Increment each product's QUANTITY
     *   4. Optionally update product buy/sell prices
     *
     * @param  array  $header
     * @param  array  $items
     * @param  bool   $updateProductPrices  Update product buy_price from this invoice
     * @return PurchaseInvoice
     */
    public function create(
        array $header,
        array $items,
        bool $updateProductPrices = false
    ): PurchaseInvoice {
        if (empty($items)) {
            throw new \InvalidArgumentException('A purchase invoice must have at least one item.');
        }

        return DB::transaction(function () use ($header, $items, $updateProductPrices) {

            // ── 1. Resolve supplier ───────────────────────────────
            $supplier = null;
            if (!empty($header['supplier_id'])) {
                $supplier = Supplier::lockForUpdate()->findOrFail($header['supplier_id']);
            }

            // ── 2. Calculate totals from items ────────────────────
            $subtotal     = '0.0000';
            $resolvedItems = [];

            foreach ($items as $item) {
                /** @var Product $product */
                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                $lineTotal = bcmul(
                    (string) $item['buy_price'],
                    (string) $item['quantity'],
                    4
                );

                $subtotal = bcadd($subtotal, $lineTotal, 4);

                $resolvedItems[] = [
                    'product'    => $product,
                    'item_data'  => [
                        'product_id'   => $product->id,
                        'product_code' => $product->code_id,
                        'product_name' => $product->name,
                        'unit_name'    => $item['unit_name']   ?? null,
                        'unit_factor'  => $item['unit_factor'] ?? 1,
                        'quantity'     => $item['quantity'],
                        'buy_price'    => $item['buy_price'],
                        'sell_price'   => $item['sell_price']  ?? $product->sell_price,
                        'line_total'   => $lineTotal,
                    ],
                ];
            }

            // ── 3. Apply discount ─────────────────────────────────
            $discountAmount = '0.0000';
            $discountType   = $header['discount_type'] ?? PurchaseInvoice::DISCOUNT_FIXED;

            if (!empty($header['discount_amount']) && (float) $header['discount_amount'] > 0) {
                if ($discountType === PurchaseInvoice::DISCOUNT_PERCENT) {
                    $discountAmount = bcmul(
                        $subtotal,
                        bcdiv((string) $header['discount_amount'], '100', 6),
                        4
                    );
                } else {
                    $discountAmount = (string) $header['discount_amount'];
                }
            }

            $total = bcsub($subtotal, $discountAmount, 4);

            // ── 4. Payment resolution ─────────────────────────────
            $paidAmount = (string) ($header['paid_amount'] ?? $total);
            $remaining  = bcsub($total, $paidAmount, 4);

            if (bccomp($remaining, '0', 4) < 0) {
                $remaining = '0.0000';
            }

            $status = match (true) {
                bccomp($remaining, '0', 4) <= 0    => PurchaseInvoice::STATUS_PAID,
                bccomp($paidAmount, '0', 4) === 0  => PurchaseInvoice::STATUS_UNPAID,
                default                            => PurchaseInvoice::STATUS_PARTIAL,
            };

            $paymentType = $header['payment_type'] ?? match ($status) {
                PurchaseInvoice::STATUS_PAID   => PurchaseInvoice::PAYMENT_CASH,
                PurchaseInvoice::STATUS_UNPAID => PurchaseInvoice::PAYMENT_CREDIT,
                default                        => PurchaseInvoice::PAYMENT_PARTIAL,
            };

            // ── 5. Persist invoice ────────────────────────────────
            $invoice = PurchaseInvoice::create([
                'branch_id'       => $header['branch_id'],
                'invoice_number'  => PurchaseInvoice::generateInvoiceNumber($header['branch_id']),
                'invoice_date'    => $header['invoice_date'] ?? today(),
                'supplier_id'     => $supplier?->id,
                'supplier_name'   => $supplier?->name ?? ($header['supplier_name'] ?? null),
                'cashier_id'      => $header['cashier_id'],
                'cashier_name'    => $header['cashier_name'],
                'subtotal'        => $subtotal,
                'discount_amount' => $discountAmount,
                'discount_type'   => $discountType,
                'total'           => $total,
                'payment_type'    => $paymentType,
                'paid_amount'     => $paidAmount,
                'remaining_amount' => $remaining,
                'status'          => $status,
                'notes'           => $header['notes'] ?? null,
                'created_by'      => $header['cashier_id'],
            ]);

            // ── 6. Persist items + update stock ───────────────────
            foreach ($resolvedItems as $resolved) {
                /** @var Product $product */
                $product  = $resolved['product'];
                $itemData = $resolved['item_data'];

                $invoice->items()->create($itemData);

                // Increment stock (opposite of sale)
                $product->incrementStock((float) $itemData['quantity']);

                // Optionally update product cost price from this purchase
                if ($updateProductPrices) {
                    $product->buy_price = $itemData['buy_price'];

                    // Only update sell_price if explicitly provided in the item
                    if (!empty($itemData['sell_price'])) {
                        $product->sell_price = $itemData['sell_price'];
                    }

                    $product->save();
                }
            }

            // ── 7. Update supplier financials ─────────────────────
            if ($supplier) {
                $supplier->addInvoiceTotal((float) $total);

                if (bccomp($paidAmount, '0', 4) > 0) {
                    $supplier->recordPayment((float) $paidAmount);
                }
            }

            // ── 8. Record in treasury ────────────────────────────────
            if (bccomp($paidAmount, '0', 4) > 0) {
                $this->treasuryService->recordFromPurchase(
                    $invoice,
                    (float) $paidAmount,
                    $header['cashier_id']
                );
            }

            return $invoice->load('items');
        });
    }

    /**
     * Record a payment to supplier against an existing purchase invoice.
     * Mirrors Android "settle supplier debt" flow.
     */
    public function collectPayment(PurchaseInvoice $invoice, float $amount): PurchaseInvoice
    {
        return DB::transaction(function () use ($invoice, $amount) {
            $invoice->lockForUpdate();
            $invoice->recordPayment($amount);

            if ($invoice->supplier) {
                $invoice->supplier->recordPayment($amount);
            }

            return $invoice->fresh();
        });
    }
}
