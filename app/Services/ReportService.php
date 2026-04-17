<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportService extends BaseService
{
    private int $scale = 4;

    /**
     * Get a summary of sales performance.
     */
    public function salesSummary(Carbon $from, Carbon $to, ?int $branchId = null): array
    {
        $query = DB::table('sale_invoices')
            ->whereBetween('invoiced_at', [$from, $to])
            ->whereNull('deleted_at');

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        $invoices = $query->get(['total', 'cost', 'profit', 'discount']);

        $totalSales = '0.0000';
        $totalCost = '0.0000';
        $totalProfit = '0.0000';
        $totalDiscount = '0.0000';

        foreach ($invoices as $invoice) {
            $totalSales = bcadd($totalSales, (string) $invoice->total, $this->scale);
            $totalCost = bcadd($totalCost, (string) $invoice->cost, $this->scale);
            $totalProfit = bcadd($totalProfit, (string) $invoice->profit, $this->scale);
            $totalDiscount = bcadd($totalDiscount, (string) $invoice->discount, $this->scale);
        }

        return [
            'total_sales' => (float) $totalSales,
            'total_cost' => (float) $totalCost,
            'total_profit' => (float) $totalProfit,
            'total_discount' => (float) $totalDiscount,
            'invoice_count' => $invoices->count(),
        ];
    }

    /**
     * Get top selling products by quantity.
     */
    public function topProducts(Carbon $from, Carbon $to, int $limit = 10): Collection
    {
        return DB::table('sale_invoice_items')
            ->join('sale_invoices', 'sale_invoice_items.sale_invoice_id', '=', 'sale_invoices.id')
            ->select(
                'sale_invoice_items.product_id',
                'sale_invoice_items.product_name',
                'sale_invoice_items.code_id',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(line_total) as total_revenue')
            )
            ->whereBetween('sale_invoices.invoiced_at', [$from, $to])
            ->whereNull('sale_invoices.deleted_at')
            ->groupBy('sale_invoice_items.product_id', 'sale_invoice_items.product_name', 'sale_invoice_items.code_id')
            ->orderBy('total_quantity', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get sales performance by cashier (user).
     */
    public function cashierPerformance(Carbon $from, Carbon $to): Collection
    {
        return DB::table('sale_invoices')
            ->join('users', 'sale_invoices.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.name',
                DB::raw('COUNT(sale_invoices.id) as invoice_count'),
                DB::raw('SUM(sale_invoices.total) as total_sales')
            )
            ->whereBetween('sale_invoices.invoiced_at', [$from, $to])
            ->whereNull('sale_invoices.deleted_at')
            ->groupBy('users.id', 'users.name')
            ->orderBy('total_sales', 'desc')
            ->get();
    }

    /**
     * Get report of customer debts.
     */
    public function customerDebtReport(?int $customerId = null): Collection
    {
        $query = DB::table('customers')
            ->select('id', 'name', 'phone', 'current_balance')
            ->where('current_balance', '>', 0)
            ->whereNull('deleted_at');

        if ($customerId) {
            $query->where('id', $customerId);
        }

        return $query->orderBy('current_balance', 'desc')->get();
    }

    /**
     * Get current stock levels with low stock alerts.
     */
    public function stockReport(?int $categoryId = null): Collection
    {
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.name',
                'products.code_id',
                'products.quantity',
                'categories.name as category_name'
            )
            ->whereNull('products.deleted_at');

        if ($categoryId) {
            $query->where('products.category_id', $categoryId);
        }

        return $query->get()->map(function ($product) {
            $product->is_low_stock = $product->quantity <= 5;
            return $product;
        });
    }

    /**
     * Get movements (sales and purchases) for a specific product code.
     */
    public function productMovement(string $codeId, Carbon $from, Carbon $to): array
    {
        // 1. Fetch Sales
        $sales = DB::table('sale_invoice_items')
            ->join('sale_invoices', 'sale_invoice_items.sale_invoice_id', '=', 'sale_invoices.id')
            ->select(
                'sale_invoices.invoiced_at as date',
                'sale_invoice_items.quantity as out_qty',
                DB::raw('0 as in_qty'),
                'sale_invoice_items.sell_price as price',
                DB::raw("'Sale' as type"),
                'sale_invoices.invoice_number as reference'
            )
            ->where('sale_invoice_items.code_id', $codeId)
            ->whereBetween('sale_invoices.invoiced_at', [$from, $to])
            ->whereNull('sale_invoices.deleted_at')
            ->get();

        // 2. Fetch Purchases
        $purchases = DB::table('purchase_invoice_items')
            ->join('purchase_invoices', 'purchase_invoice_items.purchase_invoice_id', '=', 'purchase_invoices.id')
            ->select(
                'purchase_invoices.invoiced_at as date',
                DB::raw('0 as out_qty'),
                'purchase_invoice_items.quantity as in_qty',
                'purchase_invoice_items.buy_price as price',
                DB::raw("'Purchase' as type"),
                'purchase_invoices.invoice_number as reference'
            )
            ->where('purchase_invoice_items.code_id', $codeId)
            ->whereBetween('purchase_invoices.invoiced_at', [$from, $to])
            ->whereNull('purchase_invoices.deleted_at')
            ->get();

        // 3. Combine and sort
        $movements = $sales->concat($purchases)->sortBy('date')->values();

        return [
            'code_id' => $codeId,
            'movements' => $movements,
            'summary' => [
                'total_in' => $movements->sum('in_qty'),
                'total_out' => $movements->sum('out_qty'),
            ]
        ];
    }

    /**
     * Get a daily report for the treasury branch cash flow.
     */
    public function treasuryDailyReport(Carbon $date, int $branchId): array
    {
        $transactions = DB::table('treasury_transactions')
            ->whereDate('transacted_at', $date)
            ->where('branch_id', $branchId)
            ->whereNull('deleted_at')
            ->get(['amount', 'type']);

        $summary = [
            'deposit' => '0.0000',
            'withdrawal' => '0.0000',
            'expense' => '0.0000',
            'sale_receipt' => '0.0000',
            'purchase_payment' => '0.0000',
            'net_flow' => '0.0000',
        ];

        foreach ($transactions as $trans) {
            $summary[$trans->type] = bcadd($summary[$trans->type], (string)$trans->amount, $this->scale);
        }

        // Net flow = (deposit + receipt) - (withdrawal + expense + payment)
        $inflow = bcadd($summary['deposit'], $summary['sale_receipt'], $this->scale);
        $outflow = bcadd($summary['withdrawal'], bcadd($summary['expense'], $summary['purchase_payment'], $this->scale), $this->scale);
        
        $summary['net_flow'] = bcsub($inflow, $outflow, $this->scale);

        // Convert back to floats for reporting
        return array_map('floatval', $summary);
    }
}
