<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleInvoice;
use App\Models\SaleInvoiceItem;
use Illuminate\Support\Facades\DB;

class SaleInvoiceService
{
    /**
     * Create a complete sale invoice atomically.
     *
     * @param  array  $header   Invoice-level data
     * @param  array  $items    Array of line item data
     * @return SaleInvoice
     *
     * @throws \RuntimeException|\InvalidArgumentException
     */
    public function create(array $header, array $items): SaleInvoice
    {
        if (empty($items)) {
            throw new \InvalidArgumentException('A sale invoice must have at least one item.');
        }

        return DB::transaction(function () use ($header, $items) {

            // ── 1. Resolve customer & snapshot previous debt ──────
            $customer     = null;
            $previousDebt = '0.0000';

            if (!empty($header['customer_id'])) {
                $customer     = Customer::lockForUpdate()->findOrFail($header['customer_id']);
                $previousDebt = $customer->current_debt; // accessor from Prompt 3

                // Enforce credit limit
                if ($customer->isOverCreditLimit()) {
                    throw new \RuntimeException(
                        "Customer [{$customer->name}] has exceeded their credit limit."
                    );
                }
            }

            // ── 2. Calculate totals from items ────────────────────
            $subtotal = '0.0000';
            $totalCost = '0.0000';
            $resolvedItems = [];

            foreach ($items as $item) {
                /** @var Product $product */
                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                // Decrement stock — throws if insufficient
                $product->decrementStock((float) $item['quantity']);

                $lineTotal = bcmul(
                    (string) $item['sell_price'],
                    (string) $item['quantity'],
                    4
                );
                $lineCost = bcmul(
                    (string) ($item['buy_price'] ?? $product->buy_price),
                    (string) $item['quantity'],
                    4
                );

                $subtotal  = bcadd($subtotal, $lineTotal, 4);
                $totalCost = bcadd($totalCost, $lineCost, 4);

                $resolvedItems[] = [
                    'product_id'   => $product->id,
                    'product_code' => $product->code_id,
                    'product_name' => $product->name,
                    'price_type'   => $item['price_type']  ?? 'one',
                    'unit_name'    => $item['unit_name']   ?? null,
                    'unit_factor'  => $item['unit_factor'] ?? 1,
                    'quantity'     => $item['quantity'],
                    'sell_price'   => $item['sell_price'],
                    'buy_price'    => $item['buy_price'] ?? $product->buy_price,
                    'line_total'   => $lineTotal,
                ];
            }

            // ── 3. Apply discount ─────────────────────────────────
            $discountAmount = '0.0000';
            $discountType   = $header['discount_type'] ?? SaleInvoice::DISCOUNT_FIXED;

            if (!empty($header['discount_amount']) && (float) $header['discount_amount'] > 0) {
                if ($discountType === SaleInvoice::DISCOUNT_PERCENT) {
                    $discountAmount = bcmul(
                        $subtotal,
                        bcdiv((string) $header['discount_amount'], '100', 6),
                        4
                    );
                } else {
                    $discountAmount = (string) $header['discount_amount'];
                }
            }

            $total  = bcsub($subtotal, $discountAmount, 4);
            $profit = bcsub($total, $totalCost, 4);

            // ── 4. Payment resolution ─────────────────────────────
            $paidAmount = (string) ($header['paid_amount'] ?? $total);
            $remaining  = bcsub($total, $paidAmount, 4);

            if (bccomp($remaining, '0', 4) < 0) {
                $remaining = '0.0000'; // overpayment — handle as credit separately
            }

            $status = match (true) {
                bccomp($remaining, '0', 4) <= 0 => SaleInvoice::STATUS_PAID,
                bccomp($paidAmount, '0', 4) === 0 => SaleInvoice::STATUS_UNPAID,
                default                           => SaleInvoice::STATUS_PARTIAL,
            };

            $paymentType = $header['payment_type'] ?? match ($status) {
                SaleInvoice::STATUS_PAID    => SaleInvoice::PAYMENT_CASH,
                SaleInvoice::STATUS_UNPAID  => SaleInvoice::PAYMENT_CREDIT,
                default                     => SaleInvoice::PAYMENT_PARTIAL,
            };

            // ── 5. Persist invoice ────────────────────────────────
            $invoice = SaleInvoice::create([
                'branch_id'       => $header['branch_id'],
                'invoice_number'  => SaleInvoice::generateInvoiceNumber($header['branch_id']),
                'invoice_date'    => $header['invoice_date'] ?? today(),
                'customer_id'     => $customer?->id,
                'customer_name'   => $customer?->name ?? ($header['customer_name'] ?? null),
                'cashier_id'      => $header['cashier_id'],
                'cashier_name'    => $header['cashier_name'],
                'subtotal'        => $subtotal,
                'discount_amount' => $discountAmount,
                'discount_type'   => $discountType,
                'total'           => $total,
                'cost'            => $totalCost,
                'profit'          => $profit,
                'payment_type'    => $paymentType,
                'paid_amount'     => $paidAmount,
                'remaining_amount' => $remaining,
                'previous_debt'   => $previousDebt,
                'status'          => $status,
                'notes'           => $header['notes'] ?? null,
                'created_by'      => $header['cashier_id'],
            ]);

            // ── 6. Persist line items ─────────────────────────────
            foreach ($resolvedItems as $item) {
                $invoice->items()->create($item);
            }

            // ── 7. Update customer financials ─────────────────────
            if ($customer) {
                $customer->addInvoiceTotal((float) $total);
                if (bccomp($paidAmount, '0', 4) > 0) {
                    $customer->recordPayment((float) $paidAmount);
                }
            }

            return $invoice->load('items');
        });
    }

    /**
     * Collect a payment against an existing invoice.
     * Mirrors the Android "collect debt" flow.
     */
    public function collectPayment(SaleInvoice $invoice, float $amount): SaleInvoice
    {
        return DB::transaction(function () use ($invoice, $amount) {
            $invoice->lockForUpdate();
            $invoice->recordPayment($amount);

            if ($invoice->customer) {
                $invoice->customer->recordPayment($amount);
            }

            return $invoice->fresh();
        });
    }
}
