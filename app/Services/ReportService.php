<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Installment;
use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\SaleInvoice;
use App\Models\SaleInvoiceItem;
use App\Models\Supplier;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Sales Summary Report.
     * Aggregates totals from sale_invoices.
     */
    public function salesSummary(int $branchId, string $dateFrom, string $dateTo): array
    {
        $stats = DB::table('sale_invoices')
            ->where('branch_id', $branchId)
            ->whereBetween('invoice_date', [$dateFrom, $dateTo])
            ->where('status', '!=', SaleInvoice::STATUS_CANCELLED)
            ->select([
                DB::raw('COUNT(id) as total_invoices'),
                DB::raw('SUM(subtotal) as gross_sales'),
                DB::raw('SUM(discount_amount) as total_discount'),
                DB::raw('SUM(total) as net_sales'),
                DB::raw('SUM(cost) as total_cost'),
                DB::raw('SUM(profit) as total_profit'),
            ])
            ->first();

        return [
            'total_invoices' => (int) ($stats->total_invoices ?? 0),
            'gross_sales'    => (string) ($stats->gross_sales    ?? '0.0000'),
            'total_discount' => (string) ($stats->total_discount ?? '0.0000'),
            'net_sales'      => (string) ($stats->net_sales      ?? '0.0000'),
            'total_cost'     => (string) ($stats->total_cost     ?? '0.0000'),
            'total_profit'   => (string) ($stats->total_profit   ?? '0.0000'),
        ];
    }

    /**
     * Payment Type Breakdown.
     * Shows cash vs credit vs partial sales.
     */
    public function paymentBreakdown(int $branchId, string $dateFrom, string $dateTo): array
    {
        $rows = DB::table('sale_invoices')
            ->where('branch_id', $branchId)
            ->whereBetween('invoice_date', [$dateFrom, $dateTo])
            ->where('status', '!=', SaleInvoice::STATUS_CANCELLED)
            ->select([
                'payment_type',
                DB::raw('SUM(total) as total_amount'),
                DB::raw('SUM(remaining_amount) as uncollected_amount'),
            ])
            ->groupBy('payment_type')
            ->get();

        $breakdown = [
            'cash_total'        => '0.0000',
            'credit_total'      => '0.0000',
            'partial_total'     => '0.0000',
            'uncollected_total' => '0.0000',
        ];

        foreach ($rows as $row) {
            if ($row->payment_type === SaleInvoice::PAYMENT_CASH) {
                $breakdown['cash_total'] = (string) $row->total_amount;
            } elseif ($row->payment_type === SaleInvoice::PAYMENT_CREDIT) {
                $breakdown['credit_total'] = (string) $row->total_amount;
            } elseif ($row->payment_type === SaleInvoice::PAYMENT_PARTIAL) {
                $breakdown['partial_total'] = (string) $row->total_amount;
            }
            
            $breakdown['uncollected_total'] = bcadd(
                $breakdown['uncollected_total'],
                (string) $row->uncollected_amount,
                4
            );
        }

        return $breakdown;
    }

    /**
     * Top Selling Products.
     * Order by total revenue generated.
     */
    public function topProducts(int $branchId, string $dateFrom, string $dateTo, int $limit = 10): Collection
    {
        return DB::table('sale_invoice_items')
            ->join('sale_invoices', 'sale_invoice_items.sale_invoice_id', '=', 'sale_invoices.id')
            ->where('sale_invoices.branch_id', $branchId)
            ->whereBetween('sale_invoices.invoice_date', [$dateFrom, $dateTo])
            ->where('sale_invoices.status', '!=', SaleInvoice::STATUS_CANCELLED)
            ->select([
                'product_code',
                'product_name',
                DB::raw('SUM(quantity) as total_qty_sold'),
                DB::raw('SUM(line_total) as total_revenue'),
                DB::raw('SUM((sell_price - buy_price) * quantity) as total_profit'),
            ])
            ->groupBy('product_code', 'product_name')
            ->orderBy('total_revenue', 'DESC')
            ->limit($limit)
            ->get();
    }

    /**
     * Customer Debt Report.
     * Lists customers with outstanding balances.
     */
    public function customerDebts(int $branchId): Collection
    {
        // current_debt = total_invoiced - paid_amount
        return DB::table('customers')
            ->where('branch_id', $branchId)
            ->select([
                'id',
                'name',
                'phone',
                'total_invoiced',
                'paid_amount',
                DB::raw('(total_invoiced - paid_amount) as current_debt'),
            ])
            ->having('current_debt', '>', 0)
            ->orderBy('current_debt', 'DESC')
            ->get();
    }

    /**
     * Supplier Balance Report.
     * Lists suppliers we owe money to.
     */
    public function supplierBalances(int $branchId): Collection
    {
        // net_balance = total_invoiced - paid_amount + balance_adjustment
        return DB::table('suppliers')
            ->where('branch_id', $branchId)
            ->select([
                'id',
                'name',
                'phone',
                DB::raw('(total_invoiced - paid_amount + balance_adjustment) as net_balance'),
            ])
            ->having('net_balance', '>', 0)
            ->orderBy('net_balance', 'DESC')
            ->get();
    }

    /**
     * Stock Status Report.
     * Shows current inventory levels and flags low stock.
     */
    public function stockStatus(int $branchId): Collection
    {
        return DB::table('products')
            ->where('branch_id', $branchId)
            ->select([
                'code_id as product_code',
                'name',
                'quantity',
                'min_quantity',
                'sell_price',
                'buy_price',
                DB::raw('CASE WHEN quantity <= min_quantity THEN 1 ELSE 0 END as is_low_stock'),
            ])
            ->orderBy('is_low_stock', 'DESC')
            ->orderBy('name', 'ASC')
            ->get();
    }

    /**
     * Treasury Summary Report.
     * Tracks cash flow movements.
     */
    public function treasurySummary(int $branchId, string $dateFrom, string $dateTo): array
    {
        // 1. Opening Balance (last balance_after before dateFrom)
        $opening = DB::table('treasury_transactions')
            ->where('branch_id', $branchId)
            ->where('transaction_date', '<', $dateFrom)
            ->orderBy('id', 'desc')
            ->value('balance_after') ?? '0.0000';

        // 2. Aggregate transactions within period
        $stats = DB::table('treasury_transactions')
            ->where('branch_id', $branchId)
            ->whereBetween('transaction_date', [$dateFrom, $dateTo])
            ->select([
                DB::raw("SUM(CASE WHEN type IN ('deposit', 'sale_payment', 'opening_balance') THEN amount ELSE 0 END) as total_deposits"),
                DB::raw("SUM(CASE WHEN type = 'withdrawal' THEN amount ELSE 0 END) as total_withdrawals"),
                DB::raw("SUM(CASE WHEN type IN ('expense', 'purchase_payment') THEN amount ELSE 0 END) as total_expenses"),
            ])
            ->first();

        // 3. Current Balance (last balance_after on or before dateTo)
        $current = DB::table('treasury_transactions')
            ->where('branch_id', $branchId)
            ->where('transaction_date', '<=', $dateTo)
            ->orderBy('id', 'desc')
            ->value('balance_after') ?? '0.0000';

        return [
            'opening_balance'   => (string) $opening,
            'total_deposits'    => (string) ($stats->total_deposits    ?? '0.0000'),
            'total_withdrawals' => (string) ($stats->total_withdrawals ?? '0.0000'),
            'total_expenses'    => (string) ($stats->total_expenses    ?? '0.0000'),
            'current_balance'   => (string) $current,
        ];
    }

    /**
     * Overdue Installments Report.
     * Lists unpaid credit payments past their due date.
     */
    public function overdueInstallments(int $branchId): Collection
    {
        return DB::table('installments')
            ->join('sale_invoices', 'installments.sale_invoice_id', '=', 'sale_invoices.id')
            ->where('sale_invoices.branch_id', $branchId)
            ->where('installments.status', Installment::STATUS_NOT_PAID)
            ->where('installments.collect_date', '<', now()->toDateString())
            ->select([
                'installments.client_name',
                'installments.guarantor_name',
                'installments.amount',
                'installments.collect_date',
                'sale_invoices.invoice_number',
                DB::raw('DATEDIFF(NOW(), installments.collect_date) as days_overdue'),
            ])
            ->orderBy('days_overdue', 'DESC')
            ->get();
    }
}
