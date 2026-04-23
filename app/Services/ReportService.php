<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Sales summary aggregates for the given branch and date range.
     * Excludes cancelled invoices and soft-deleted rows.
     */
    public function salesSummary(int $branchId, string $dateFrom, string $dateTo): array
    {
        $row = DB::table('sale_invoices')
            ->where('branch_id', $branchId)
            ->whereBetween('invoice_date', [$dateFrom, $dateTo])
            ->where('status', '!=', 'cancelled')
            ->whereNull('deleted_at')
            ->select([
                DB::raw('COUNT(id)                as total_invoices'),
                DB::raw('SUM(subtotal)            as gross_sales'),
                DB::raw('SUM(discount_amount)     as total_discount'),
                DB::raw('SUM(total)               as net_sales'),
                DB::raw('SUM(cost)                as total_cost'),
                DB::raw('SUM(profit)              as total_profit'),
                DB::raw('SUM(paid_amount)         as cash_collected'),
                DB::raw('SUM(remaining_amount)    as total_remaining'),
            ])
            ->first();

        return [
            'total_invoices'  => (int)    ($row->total_invoices  ?? 0),
            'gross_sales'     => (string) ($row->gross_sales     ?? '0.0000'),
            'total_discount'  => (string) ($row->total_discount  ?? '0.0000'),
            'net_sales'       => (string) ($row->net_sales       ?? '0.0000'),
            'total_cost'      => (string) ($row->total_cost      ?? '0.0000'),
            'total_profit'    => (string) ($row->total_profit    ?? '0.0000'),
            'cash_collected'  => (string) ($row->cash_collected  ?? '0.0000'),
            'total_remaining' => (string) ($row->total_remaining ?? '0.0000'),
        ];
    }

    /**
     * Breakdown of invoice totals grouped by payment_type.
     * Returns array keyed by type; each entry has count and total.
     */
    public function paymentBreakdown(int $branchId, string $dateFrom, string $dateTo): array
    {
        $rows = DB::table('sale_invoices')
            ->where('branch_id', $branchId)
            ->whereBetween('invoice_date', [$dateFrom, $dateTo])
            ->where('status', '!=', 'cancelled')
            ->whereNull('deleted_at')
            ->select([
                'payment_type',
                DB::raw('COUNT(id)      as count'),
                DB::raw('SUM(total)    as total'),
            ])
            ->groupBy('payment_type')
            ->get()
            ->keyBy('payment_type');

        $zero = ['count' => 0, 'total' => '0.0000'];

        return [
            'cash'    => isset($rows['cash'])    ? ['count' => (int) $rows['cash']->count,    'total' => (string) $rows['cash']->total]    : $zero,
            'credit'  => isset($rows['credit'])  ? ['count' => (int) $rows['credit']->count,  'total' => (string) $rows['credit']->total]  : $zero,
            'partial' => isset($rows['partial']) ? ['count' => (int) $rows['partial']->count, 'total' => (string) $rows['partial']->total] : $zero,
        ];
    }

    /**
     * Top-selling products by revenue in the period.
     */
    public function topProducts(int $branchId, string $dateFrom, string $dateTo, int $limit = 10): Collection
    {
        return DB::table('sale_invoice_items')
            ->join('sale_invoices', 'sale_invoice_items.sale_invoice_id', '=', 'sale_invoices.id')
            ->where('sale_invoices.branch_id', $branchId)
            ->whereBetween('sale_invoices.invoice_date', [$dateFrom, $dateTo])
            ->where('sale_invoices.status', '!=', 'cancelled')
            ->whereNull('sale_invoices.deleted_at')
            ->select([
                'sale_invoice_items.product_code',
                'sale_invoice_items.product_name',
                DB::raw('SUM(sale_invoice_items.quantity)                                          as total_qty'),
                DB::raw('SUM(sale_invoice_items.line_total)                                        as total_revenue'),
                DB::raw('SUM((sale_invoice_items.sell_price - sale_invoice_items.buy_price) * sale_invoice_items.quantity) as total_profit'),
            ])
            ->groupBy('sale_invoice_items.product_code', 'sale_invoice_items.product_name')
            ->orderByDesc('total_revenue')
            ->limit($limit)
            ->get();
    }

    /**
     * Customers with outstanding debt (total_invoiced > paid_amount).
     */
    public function customerDebts(int $branchId): Collection
    {
        return DB::table('customers')
            ->where('branch_id', $branchId)
            ->whereNull('deleted_at')
            ->select([
                'id',
                'name',
                'phone',
                'total_invoiced',
                'paid_amount',
                DB::raw('(total_invoiced - paid_amount) as current_debt'),
            ])
            ->having('current_debt', '>', 0)
            ->orderByDesc('current_debt')
            ->get();
    }

    /**
     * Suppliers with a positive net balance owed.
     * net_balance = total_invoiced - paid_amount + balance_adjustment
     */
    public function supplierBalances(int $branchId): Collection
    {
        return DB::table('suppliers')
            ->where('branch_id', $branchId)
            ->whereNull('deleted_at')
            ->select([
                'id',
                'name',
                'phone',
                DB::raw('(total_invoiced - paid_amount + balance_adjustment) as net_balance'),
            ])
            ->having('net_balance', '>', 0)
            ->orderByDesc('net_balance')
            ->get();
    }

    /**
     * Current inventory levels with low-stock flag.
     * is_low_stock = 1 when quantity <= min_quantity AND min_quantity > 0.
     */
    public function stockStatus(int $branchId): Collection
    {
        return DB::table('products')
            ->where('branch_id', $branchId)
            ->whereNull('deleted_at')
            ->select([
                'id',
                'code_id',
                'name',
                'quantity',
                'min_quantity',
                'buy_price',
                'sell_price',
                DB::raw('CASE WHEN min_quantity > 0 AND quantity <= min_quantity THEN 1 ELSE 0 END as is_low_stock'),
            ])
            ->orderByDesc('is_low_stock')
            ->orderBy('name')
            ->get();
    }

    /**
     * Treasury cash-flow summary for the period.
     *
     * opening_balance  — balance_before of the first transaction in the range
     * closing_balance  — balance_after  of the last  transaction in the range
     */
    public function treasurySummary(int $branchId, string $dateFrom, string $dateTo): array
    {
        $base = DB::table('treasury_transactions')
            ->where('branch_id', $branchId)
            ->whereNull('deleted_at')
            ->whereBetween('transaction_date', [$dateFrom, $dateTo]);

        $opening = (clone $base)
            ->orderBy('id')
            ->value('balance_before') ?? '0.0000';

        $closing = (clone $base)
            ->orderByDesc('id')
            ->value('balance_after') ?? '0.0000';

        $totals = (clone $base)
            ->select([
                DB::raw("SUM(CASE WHEN type IN ('deposit','sale_payment','opening_balance') THEN amount ELSE 0 END) as total_deposits"),
                DB::raw("SUM(CASE WHEN type = 'withdrawal'        THEN amount ELSE 0 END) as total_withdrawals"),
                DB::raw("SUM(CASE WHEN type = 'expense'           THEN amount ELSE 0 END) as total_expenses"),
                DB::raw("SUM(CASE WHEN type = 'purchase_payment'  THEN amount ELSE 0 END) as total_purchases"),
            ])
            ->first();

        return [
            'opening_balance'   => (string) $opening,
            'total_deposits'    => (string) ($totals->total_deposits    ?? '0.0000'),
            'total_withdrawals' => (string) ($totals->total_withdrawals ?? '0.0000'),
            'total_expenses'    => (string) ($totals->total_expenses    ?? '0.0000'),
            'total_purchases'   => (string) ($totals->total_purchases   ?? '0.0000'),
            'closing_balance'   => (string) $closing,
        ];
    }

    /**
     * Unpaid installments past their due date, scoped to branch via sale_invoice.
     * Maps Android latekists screen.
     */
    public function overdueInstallments(int $branchId): Collection
    {
        return DB::table('installments')
            ->join('sale_invoices', 'installments.sale_invoice_id', '=', 'sale_invoices.id')
            ->where('sale_invoices.branch_id', $branchId)
            ->where('installments.status', 'not_paid')
            ->where('installments.collect_date', '<', today()->toDateString())
            ->whereNull('installments.deleted_at')
            ->whereNull('sale_invoices.deleted_at')
            ->select([
                'installments.id',
                'installments.client_name',
                'installments.guarantor_name',
                'installments.guarantor_phone',
                'installments.amount',
                'installments.collect_date',
                'sale_invoices.invoice_number',
                DB::raw('DATEDIFF(NOW(), installments.collect_date) as days_overdue'),
            ])
            ->orderBy('installments.collect_date')
            ->get();
    }
}
