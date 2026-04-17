<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with stats grid.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $today_sales_total        = 0;
        $today_profit             = 0;
        $today_sales_count        = 0;
        $treasury_balance         = 0;
        $low_stock_count          = 0;
        $overdue_installments_count = 0;
        $total_customers          = 0;
        $total_products           = 0;

        try {
            $today_sales_total = DB::table('sale_invoices')
                ->whereDate('invoiced_at', today())
                ->sum('total');
        } catch (\Exception $e) {}

        try {
            $today_profit = DB::table('sale_invoices')
                ->whereDate('invoiced_at', today())
                ->sum('profit');
        } catch (\Exception $e) {}

        try {
            $today_sales_count = DB::table('sale_invoices')
                ->whereDate('invoiced_at', today())
                ->count();
        } catch (\Exception $e) {}

        try {
            $total_customers = DB::table('customers')
                ->whereNull('deleted_at')
                ->count();
        } catch (\Exception $e) {}

        try {
            $total_products = DB::table('products')
                ->whereNull('deleted_at')
                ->count();
        } catch (\Exception $e) {}

        try {
            $low_stock_count = DB::table('products')
                ->whereNull('deleted_at')
                ->where('quantity', '<=', 5)
                ->count();
        } catch (\Exception $e) {}

        try {
            $overdue_installments_count = DB::table('installments')
                ->where('status', 'not_paid')
                ->where('due_date', '<', today())
                ->whereNull('deleted_at')
                ->count();
        } catch (\Exception $e) {}

        // Treasury balance is usually handled by a dedicated service, 
        // using 0 as default if the table doesn't exist yet.
        try {
            $treasury_balance = DB::table('treasury_transactions')
                ->sum('amount');
        } catch (\Exception $e) {}

        return view('dashboard', compact(
            'today_sales_total',
            'today_profit',
            'today_sales_count',
            'treasury_balance',
            'low_stock_count',
            'overdue_installments_count',
            'total_customers',
            'total_products'
        ));
    }
}
