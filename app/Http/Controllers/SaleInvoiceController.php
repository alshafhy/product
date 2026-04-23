<?php

namespace App\Http\Controllers;

use App\Models\SaleInvoice;
use App\Services\SaleInvoiceService;
use App\Http\Requests\SaleInvoice\StoreSaleInvoiceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class SaleInvoiceController extends Controller
{
    protected SaleInvoiceService $service;

    public function __construct(SaleInvoiceService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        Gate::authorize('sale_invoice.view');
        $invoices = SaleInvoice::with(['customer', 'cashier', 'branch'])->latest()->paginate(20);
        return view('dashboard.sale_invoices.index', compact('invoices'));
    }

    public function create(): View
    {
        Gate::authorize('sale_invoice.create');
        // Views will handle loading products/customers via API or props
        return view('dashboard.sale_invoices.create');
    }

    public function store(StoreSaleInvoiceRequest $request): RedirectResponse
    {
        $header = $request->only([
            'branch_id', 'customer_id', 'invoice_date', 'discount_amount', 
            'discount_type', 'payment_type', 'paid_amount', 'notes'
        ]);
        $header['cashier_id'] = auth()->id();
        $header['cashier_name'] = auth()->user()->name;

        $invoice = $this->service.create($header, $request->input('items'));

        return redirect()->route('dashboard.sale-invoices.show', $invoice->id)
            ->with('success', 'Invoice created successfully.');
    }

    public function show(SaleInvoice $saleInvoice): View
    {
        Gate::authorize('sale_invoice.view');
        $saleInvoice->load(['items', 'customer', 'cashier']);
        return view('dashboard.sale_invoices.show', compact('saleInvoice'));
    }

    /**
     * Custom action: Collect payment for credit/partial invoice.
     */
    public function collectDebt(Request $request, SaleInvoice $saleInvoice): RedirectResponse
    {
        Gate::authorize('sale_invoice.collect_debt');
        
        $request->validate(['amount' => 'required|numeric|gt:0']);
        
        $this->service.collectPayment($saleInvoice, (float) $request->input('amount'));

        return back()->with('success', 'Payment recorded successfully.');
    }

    public function destroy(SaleInvoice $saleInvoice): RedirectResponse
    {
        Gate::authorize('sale_invoice.delete');
        $saleInvoice->delete();
        return redirect()->route('dashboard.sale-invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
