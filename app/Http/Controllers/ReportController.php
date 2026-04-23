<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    protected ReportService $service;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    }

    public function sales(Request $request): View
    {
        Gate::authorize('report.sales');
        
        $branchId = $request->input('branch_id', auth()->user()->branch_id);
        $from = $request->input('from', today()->startOfMonth()->toDateString());
        $to   = $request->input('to', today()->toDateString());

        $summary   = $this->service.salesSummary($branchId, $from, $to);
        $breakdown = $this->service.paymentBreakdown($branchId, $from, $to);
        $top       = $this->service.topProducts($branchId, $from, $to);

        return view('dashboard.reports.sales', compact('summary', 'breakdown', 'top', 'from', 'to'));
    }

    public function stock(Request $request): View
    {
        Gate::authorize('report.stock');
        
        $branchId = $request->input('branch_id', auth()->user()->branch_id);
        $stock = $this->service.stockStatus($branchId);

        return view('dashboard.reports.stock', compact('stock'));
    }

    public function customers(Request $request): View
    {
        Gate::authorize('report.customers');
        
        $branchId = $request->input('branch_id', auth()->user()->branch_id);
        $debts = $this->service.customerDebts($branchId);

        return view('dashboard.reports.customers', compact('debts'));
    }

    public function suppliers(Request $request): View
    {
        Gate::authorize('report.suppliers');
        
        $branchId = $request->input('branch_id', auth()->user()->branch_id);
        $balances = $this->service.supplierBalances($branchId);

        return view('dashboard.reports.suppliers', compact('balances'));
    }

    public function treasury(Request $request): View
    {
        Gate::authorize('report.treasury');
        
        $branchId = $request->input('branch_id', auth()->user()->branch_id);
        $from = $request->input('from', today()->startOfMonth()->toDateString());
        $to   = $request->input('to', today()->toDateString());

        $summary = $this->service.treasurySummary($branchId, $from, $to);

        return view('dashboard.reports.treasury', compact('summary', 'from', 'to'));
    }

    public function installments(Request $request): View
    {
        Gate::authorize('report.installments');
        
        $branchId = $request->input('branch_id', auth()->user()->branch_id);
        $overdue = $this->service.overdueInstallments($branchId);

        return view('dashboard.reports.installments', compact('overdue'));
    }
}
