<?php

namespace App\Services;

use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceItem;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchaseInvoiceService
{
    /**
     * Create a new purchase invoice.
     */
    public function createInvoice(array $data, array $items): PurchaseInvoice
    {
        return DB::transaction(function () use ($data, $items) {
            $total = '0';
            foreach ($items as $item) {
                $lineTotal = bcmul((string) $item['quantity'], (string) $item['buy_price'], 4);
                $total = bcadd($total, $lineTotal, 4);
            }

            $invoiceData = array_merge($data, [
                'total' => $total,
                'remaining' => bcsub($total, $data['paid'] ?? '0', 4),
                'invoice_number' => $this->generateInvoiceNumber($data['branch_id']),
                'invoiced_at' => $data['invoiced_at'] ?? now(),
            ]);

            $invoice = PurchaseInvoice::create($invoiceData);

            foreach ($items as $itemData) {
                $product = Product::findOrFail($itemData['product_id']);
                
                $item = PurchaseInvoiceItem::create([
                    'purchase_invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'code_id' => $product->code_id,
                    'quantity' => $itemData['quantity'],
                    'unit_name' => $itemData['unit_name'] ?? $product->unit1,
                    'buy_price' => $itemData['buy_price'],
                    'suggested_sell_price' => $itemData['suggested_sell_price'] ?? '0',
                    'line_total' => bcmul((string) $itemData['quantity'], (string) $itemData['buy_price'], 4),
                ]);

                // Update product cost if requested or default
                $this->updateProductCostPrice($item, true);
            }

            if ($invoice->status === 'completed') {
                $this->receiveStock($invoice);
            }

            $this->handleSupplierDebt($invoice);

            return $invoice;
        });
    }

    /**
     * Increment stock based on purchase items.
     */
    public function receiveStock(PurchaseInvoice $invoice): void
    {
        foreach ($invoice->items as $item) {
            $product = $item->product;
            $product->increment('quantity', (float) $item->quantity);
        }
    }

    /**
     * Update product's cost price based on latest purchase.
     */
    public function updateProductCostPrice(PurchaseInvoiceItem $item, bool $force = false): void
    {
        $product = $item->product;
        // Optionally update the primary buy_price
        $product->update(['buy_price' => $item->buy_price]);
    }

    /**
     * Update supplier balance.
     */
    public function handleSupplierDebt(PurchaseInvoice $invoice): void
    {
        if ($invoice->supplier_id) {
            $invoice->supplier->recalculateBalance();
        }
    }

    /**
     * Generate unique purchase invoice number.
     */
    public function generateInvoiceNumber(int $branchId): string
    {
        $date = now()->format('Ymd');
        $count = PurchaseInvoice::where('branch_id', $branchId)
            ->whereDate('created_at', Carbon::today())
            ->count() + 1;
            
        $seq = str_pad($count, 4, '0', STR_PAD_LEFT);
        
        return "PUR-{$branchId}-{$date}-{$seq}";
    }
}
