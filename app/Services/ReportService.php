<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ReportService
{
    /**
     * Get sales summary for a date range and optional branch.
     */
    public function salesSummary(Carbon $from, Carbon $to, ?int $branchId = null): array
    {
        $query = DB::table('sale_invoices')
            ->whereBetween('invoiced_at', [$from, $to])
            ->where('status', 'completed');

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        $summary = $query->selectRaw('
            SUM(total) as total_sales,
            SUM(cost) as total_cost,
            SUM(profit) as total_profit,
            SUM(discount) as total_discount,
            COUNT(id) as invoice_count
        ')->first();

        return [
            'total_sales' => (string) ($summary->total_sales ?? '0'),
            'total_cost' => (string) ($summary->total_cost ?? '0'),
            'total_profit' => (string) ($summary->total_profit ?? '0'),
            'total_discount' => (string) ($summary->total_discount ?? '0'),
            'invoice_count' => (int) ($summary->invoice_count ?? 0),
        ];
    }

    /**
     * Get top selling products.
     */
    public function topProducts(Carbon $from, Carbon $to, int $limit = 10): Collection
    {
        return DB::table('sale_invoice_items')
            ->join('sale_invoices', 'sale_invoice_items.sale_invoice_id', '=', 'sale_invoices.id')
            ->whereBetween('sale_invoices.invoiced_at', [$from, $to])
            ->where('sale_invoices.status', 'completed')
            ->select('sale_invoice_items.product_id', 'sale_invoice_items.product_name', 'sale_invoice_items.code_id')
            ->selectRaw('SUM(sale_invoice_items.quantity) as total_quantity')
            ->selectRaw('SUM(sale_invoice_items.line_total) as total_revenue')
            ->groupBy('sale_invoice_items.product_id', 'sale_invoice_items.product_name', 'sale_invoice_items.code_id')
            ->orderByDesc('total_quantity')
            ->limit($limit)
            ->get();
    }

    /**
     * Get performance report for all cashiers.
     */
    public function cashierPerformance(Carbon $from, Carbon $to): Collection
    {
        return DB::table('sale_invoices')
            ->join('users', 'sale_invoices.user_id', '=', 'users.id')
            ->whereBetween('sale_invoices.invoiced_at', [$from, $to])
            ->where('sale_invoices.status', 'completed')
            ->select('users.id', 'users.name')
            ->selectRaw('SUM(sale_invoices.total) as total_sales')
            ->selectRaw('COUNT(sale_invoices.id) as invoice_count')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_sales')
            ->get();
    }

    /**
     * Get customer debt report.
     */
    public function customerDebtReport(?int $customerId = null): Collection
    {
        $query = DB::table('customers')
            ->where('current_balance', '>', 0)
            ->select('id', 'name', 'phone', 'current_balance')
            ->orderByDesc('current_balance');

        if ($customerId) {
            $query->where('id', $customerId);
        }

        return $query->get();
    }

    /**
     * Get stock report with low stock alerts.
     */
    public function stockReport(?int $categoryId = null): Collection
    {
        $query = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.name',
                'products.code_id',
                'products.quantity',
                'products.unit1',
                'categories.name as category_name'
            )
            ->selectRaw('CASE WHEN products.quantity <= 5 THEN 1 ELSE 0 END as low_stock_alert')
            ->orderBy('products.quantity');

        if ($categoryId) {
            $query->where('products.category_id', $categoryId);
        }

        return $query->get();
    }

    /**
     * Get chronological movement for a specific product.
     */
    public function productMovement(string $codeId, Carbon $from, Carbon $to): array
    {
        // 1. Get Sales
        $sales = DB::table('sale_invoice_items')
            ->join('sale_invoices', 'sale_invoice_items.sale_invoice_id', '=', 'sale_invoices.id')
            ->where('sale_invoice_items.code_id', $codeId)
            ->whereBetween('sale_invoices.invoiced_at', [$from, $to])
            ->select(
                'sale_invoices.invoiced_at as date',
                'sale_invoices.invoice_number as reference',
                DB::raw("'sale' as movement_type")
            )
            ->selectRaw('sale_invoice_items.quantity as qty_out')
            ->selectRaw('0 as qty_in')
            ->selectRaw('sale_invoice_items.sell_price as price');

        // 2. Get Purchases
        $purchases = DB::table('purchase_invoice_items')
            ->join('purchase_invoices', 'purchase_invoice_items.purchase_invoice_id', '=', 'purchase_invoices.id')
            ->where('purchase_invoice_items.code_id', $codeId)
            ->whereBetween('purchase_invoices.invoiced_at', [$from, $to])
            ->select(
                'purchase_invoices.invoiced_at as date',
                'purchase_invoices.invoice_number as reference',
                DB::raw("'purchase' as movement_type")
            )
            ->selectRaw('0 as qty_out')
            ->selectRaw('purchase_invoice_items.quantity as qty_in')
            ->selectRaw('purchase_invoice_items.buy_price as price');

        $movements = $sales->union($purchases)
            ->orderBy('date')
            ->get();

        return $movements->toArray();
    }

    /**
     * Daily treasury flow report.
     */
    public function treasuryDailyReport(Carbon $date, int $branchId): array
    {
        $transactions = DB::table('treasury_transactions')
            ->where('branch_id', $branchId)
            ->whereDate('transacted_at', $date)
            ->get();

        $in = '0';
        $out = '0';

        foreach ($transactions as $tx) {
            if (in_array($tx->type, ['deposit', 'sale_receipt'])) {
                $in = bcadd($in, (string) $tx->amount, 4);
            } else {
                $out = bcadd($out, (string) $tx->amount, 4);
            }
        }

        return [
            'date' => $date->toDateString(),
            'total_in' => $in,
            'total_out' => $out,
            'net_flow' => bcsub($in, $out, 4),
            'transaction_count' => $transactions->count(),
        ];
    }
}
