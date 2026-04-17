<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleInvoice;
use App\Models\SaleInvoiceItem;
use Illuminate\Support\Facades\DB;
use Exception;

class SaleInvoiceService extends BaseService
{
    private int $scale = 4;

    /**
     * Create a sale invoice with items and handle accounting logic.
     * 
     * @throws Exception
     */
    public function createInvoice(array $data, array $items): SaleInvoice
    {
        return DB::transaction(function () use ($data, $items) {
            // 1. Calculate Totals
            $totals = $this->calculateTotals($items, (float) ($data['discount'] ?? 0), $data['discount_type'] ?? 'fixed');
            
            // 2. Prepare Invoice Data
            $invoiceData = array_merge($data, $totals);
            $invoiceData['remaining'] = bcsub($totals['total'], (string) ($data['paid'] ?? 0), $this->scale);
            
            // Handle debt snapshot
            if (!empty($data['customer_id'])) {
                $customer = Customer::find($data['customer_id']);
                if ($customer) {
                    $invoiceData['previous_debt'] = $customer->current_balance;
                    $invoiceData['total_debt'] = bcadd((string) $customer->current_balance, (string) $invoiceData['remaining'], $this->scale);
                }
            }

            // 3. Create Invoice
            $invoice = SaleInvoice::create($invoiceData);

            // 4. Create Items and Update stock
            foreach ($items as $itemData) {
                $product = Product::findOrFail($itemData['product_id']);
                
                // Snapshot data
                $item = new SaleInvoiceItem([
                    'sale_invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'code_id' => $product->code_id,
                    'quantity' => $itemData['quantity'],
                    'unit_factor' => $itemData['unit_factor'] ?? 1,
                    'unit_name' => $itemData['unit_name'],
                    'price_type' => $itemData['price_type'] ?? 'unit1',
                    'sell_price' => $itemData['sell_price'],
                    'buy_price' => $product->buy_price, // snapshot current cost
                    'line_total' => bcmul((string) $itemData['quantity'], (string) $itemData['sell_price'], $this->scale),
                ]);
                $item->save();

                // 5. Update Stock
                $this->updateStock($product, $itemData['quantity']);
            }

            // 6. Handle Customer Debt
            $this->handleDebt($invoice);

            return $invoice;
        });
    }

    /**
     * Calculate invoice totals using BCMath.
     */
    public function calculateTotals(array $items, float $discount, string $discountType): array
    {
        $subtotal = '0.0000';
        $totalCost = '0.0000';

        foreach ($items as $item) {
            $lineTotal = bcmul((string) $item['quantity'], (string) $item['sell_price'], $this->scale);
            $subtotal = bcadd($subtotal, $lineTotal, $this->scale);
            
            // Calculate cost logic (snapshot buy_price * quantity)
            $product = Product::find($item['product_id']);
            $costPrice = $product ? (string) $product->buy_price : '0';
            $lineCost = bcmul((string) $item['quantity'], $costPrice, $this->scale);
            $totalCost = bcadd($totalCost, $lineCost, $this->scale);
        }

        $calculatedDiscount = '0.0000';
        if ($discountType === 'percentage') {
            $percentage = bcdiv((string) $discount, '100', $this->scale);
            $calculatedDiscount = bcmul($subtotal, $percentage, $this->scale);
        } else {
            $calculatedDiscount = (string) $discount;
        }

        $total = bcsub($subtotal, $calculatedDiscount, $this->scale);
        $profit = bcsub($total, $totalCost, $this->scale);

        return [
            'subtotal' => (float) $subtotal,
            'discount' => (float) $calculatedDiscount,
            'total' => (float) $total,
            'cost' => (float) $totalCost,
            'profit' => (float) $profit,
        ];
    }

    /**
     * Deduct stock from product.
     */
    public function updateStock(Product $product, float $quantity): void
    {
        $product->decrement('quantity', $quantity);
    }

    /**
     * Update customer balance if there is a remaining amount.
     */
    public function handleDebt(SaleInvoice $invoice): void
    {
        if ($invoice->customer_id && (float) $invoice->remaining > 0) {
            $invoice->customer->increment('current_balance', $invoice->remaining);
        }
    }
}
