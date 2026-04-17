<?php

namespace App\Services;

use App\Models\SaleInvoice;
use App\Models\SaleInvoiceItem;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleInvoiceService
{
    /**
     * Create a new sale invoice with all associated logic.
     */
    public function createInvoice(array $data, array $items): SaleInvoice
    {
        return DB::transaction(function () use ($data, $items) {
            // 1. Calculate Totals
            $totals = $this->calculateTotals($items, $data['discount'] ?? '0', $data['discount_type'] ?? 'value');
            
            // 2. Prepare Invoice Data
            $invoiceData = array_merge($data, $totals);
            $invoiceData['invoice_number'] = $this->generateInvoiceNumber($data['branch_id']);
            $invoiceData['remaining'] = bcsub($totals['total'], $data['paid'] ?? '0', 4);
            $invoiceData['invoiced_at'] = $data['invoiced_at'] ?? now();
            
            // Calculate Debt if Customer exists
            if (!empty($data['customer_id'])) {
                $customer = Customer::findOrFail($data['customer_id']);
                $invoiceData['previous_debt'] = (string) $customer->current_balance;
                $invoiceData['total_debt'] = bcadd($invoiceData['previous_debt'], $invoiceData['remaining'], 4);
            }

            $invoice = SaleInvoice::create($invoiceData);

            // 3. Create Items & Record Snapshots
            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                SaleInvoiceItem::create([
                    'sale_invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'code_id' => $product->code_id,
                    'quantity' => $item['quantity'],
                    'unit_factor' => $item['unit_factor'] ?? '1',
                    'unit_name' => $item['unit_name'] ?? $product->unit1,
                    'price_type' => $item['price_type'] ?? 'one',
                    'sell_price' => $item['sell_price'],
                    'buy_price' => (string) $product->buy_price,
                    'line_total' => bcmul($item['quantity'], $item['sell_price'], 4),
                ]);
            }

            // 4. Update Stock & Customer Debt
            $this->updateStock($invoice);
            $this->handleDebt($invoice);

            return $invoice;
        });
    }

    /**
     * Calculate financial totals using BCMath.
     */
    public function calculateTotals(array $items, string $discount, string $discountType): array
    {
        $subtotal = '0';
        $cost = '0';

        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $lineTotal = bcmul((string) $item['quantity'], (string) $item['sell_price'], 4);
            $lineCost = bcmul((string) $item['quantity'], (string) $product->buy_price, 4);
            
            $subtotal = bcadd($subtotal, $lineTotal, 4);
            $cost = bcadd($cost, $lineCost, 4);
        }

        $discountValue = '0';
        if ($discountType === 'percent') {
            // formula: (subtotal * discount) / 100
            $discountValue = bcdiv(bcmul($subtotal, $discount, 4), '100', 4);
        } else {
            $discountValue = $discount;
        }

        $total = bcsub($subtotal, $discountValue, 4);
        $profit = bcsub($total, $cost, 4);

        return [
            'subtotal' => $subtotal,
            'discount' => $discountValue,
            'total' => $total,
            'cost' => $cost,
            'profit' => $profit,
        ];
    }

    /**
     * Deduct stock based on unit factors.
     */
    public function updateStock(SaleInvoice $invoice): void
    {
        foreach ($invoice->items as $item) {
            $product = $item->product;
            // deduct: quantity * factor
            $deduction = bcmul((string) $item->quantity, (string) $item->unit_factor, 4);
            $product->decrement('quantity', (float) $deduction);
        }
    }

    /**
     * Update customer balance if debt exists.
     */
    public function handleDebt(SaleInvoice $invoice): void
    {
        if ($invoice->customer_id && ($invoice->payment_type === 'debt' || $invoice->payment_type === 'partial')) {
            $customer = $invoice->customer;
            $customer->recalculateBalance();
        }
    }

    /**
     * Generate unique invoice number.
     */
    public function generateInvoiceNumber(int $branchId): string
    {
        $date = now()->format('Ymd');
        $count = SaleInvoice::where('branch_id', $branchId)
            ->whereDate('created_at', Carbon::today())
            ->count() + 1;
            
        $seq = str_pad($count, 4, '0', STR_PAD_LEFT);
        
        return "INV-{$branchId}-{$date}-{$seq}";
    }
}
