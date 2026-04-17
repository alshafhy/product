<?php

namespace App\Services;

use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceItem;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Exception;

class PurchaseInvoiceService extends BaseService
{
    private int $scale = 4;

    /**
     * Create a purchase invoice and handle logistics/accounting.
     * 
     * @throws Exception
     */
    public function createInvoice(array $data, array $items): PurchaseInvoice
    {
        return DB::transaction(function () use ($data, $items) {
            // 1. Calculate totals
            $totals = $this->calculateTotals($items, (float) ($data['discount'] ?? 0), $data['discount_type'] ?? 'fixed');
            
            // 2. Prepare Invoice Data
            $invoiceData = array_merge($data, $totals);
            $invoiceData['remaining'] = bcsub((string)$totals['total'], (string)($data['paid'] ?? 0), $this->scale);
            
            // Supplier debt snapshot
            if (!empty($data['supplier_id'])) {
                $supplier = Supplier::find($data['supplier_id']);
                if ($supplier) {
                    $invoiceData['previous_debt'] = $supplier->current_balance;
                    $invoiceData['total_debt'] = bcadd((string)$supplier->current_balance, (string)$invoiceData['remaining'], $this->scale);
                }
            }

            // 3. Create Invoice
            $invoice = PurchaseInvoice::create($invoiceData);

            // 4. Create Items and Update stock/prices
            foreach ($items as $itemData) {
                $product = Product::findOrFail($itemData['product_id']);
                
                $item = new PurchaseInvoiceItem([
                    'purchase_invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'code_id' => $product->code_id,
                    'quantity' => $itemData['quantity'],
                    'unit_factor' => $itemData['unit_factor'] ?? 1,
                    'unit_name' => $itemData['unit_name'],
                    'price_type' => $itemData['price_type'] ?? 'unit1',
                    'buy_price' => $itemData['buy_price'],
                    'sell_price' => $itemData['sell_price'] ?? $product->sell_price,
                    'line_total' => bcmul((string)$itemData['quantity'], (string)$itemData['buy_price'], $this->scale),
                ]);
                $item->save();

                // 5. Receive Stock
                $this->receiveStock($product, $itemData['quantity']);
                
                // 6. Update Product cost and sell price
                $this->updateProductCostPrice($item);
            }

            // 7. Handle Supplier Debt
            $this->handleSupplierDebt($invoice);

            return $invoice;
        });
    }

    /**
     * Calculate invoice totals using BCMath.
     */
    public function calculateTotals(array $items, float $discount, string $discountType): array
    {
        $subtotal = '0.0000';

        foreach ($items as $item) {
            $lineTotal = bcmul((string)$item['quantity'], (string)$item['buy_price'], $this->scale);
            $subtotal = bcadd($subtotal, $lineTotal, $this->scale);
        }

        $calculatedDiscount = '0.0000';
        if ($discountType === 'percentage') {
            $percentage = bcdiv((string)$discount, '100', $this->scale);
            $calculatedDiscount = bcmul($subtotal, $percentage, $this->scale);
        } else {
            $calculatedDiscount = (string)$discount;
        }

        $total = bcsub($subtotal, $calculatedDiscount, $this->scale);

        return [
            'subtotal' => (float)$subtotal,
            'discount' => (float)$calculatedDiscount,
            'total' => (float)$total,
        ];
    }

    /**
     * Add stock to product.
     */
    public function receiveStock(Product $product, float $quantity): void
    {
        $product->increment('quantity', $quantity);
    }

    /**
     * Update product prices based on the purchase line.
     */
    public function updateProductCostPrice(PurchaseInvoiceItem $item): void
    {
        if ($item->product) {
            $item->product->update([
                'buy_price' => $item->buy_price,
                'sell_price' => $item->sell_price,
            ]);
        }
    }

    /**
     * Update supplier balance for unpaid invoice amounts.
     */
    public function handleSupplierDebt(PurchaseInvoice $invoice): void
    {
        if ($invoice->supplier_id && (float)$invoice->remaining > 0) {
            $invoice->supplier->increment('current_balance', $invoice->remaining);
        }
    }
}
