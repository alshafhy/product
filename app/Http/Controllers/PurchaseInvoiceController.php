<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInvoice;
use App\Services\PurchaseInvoiceService;
use App\Http\Requests\PurchaseInvoice\StorePurchaseInvoiceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class PurchaseInvoiceController extends Controller
{
    protected PurchaseInvoiceService $service;

    public function __construct(PurchaseInvoiceService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        Gate::authorize('purchase_invoice.view');
        $invoices = PurchaseInvoice::with(['supplier', 'cashier', 'branch'])->latest()->paginate(20);
        return view('dashboard.purchase_invoices.index', compact('invoices'));
    }

    public function create(): View
    {
        Gate::authorize('purchase_invoice.create');
        return view('dashboard.purchase_invoices.create');
    }

    public function store(StorePurchaseInvoiceRequest $request): RedirectResponse
    {
        $header = $request->only([
            'branch_id', 'supplier_id', 'invoice_date', 'discount_amount', 
            'discount_type', 'payment_type', 'paid_amount', 'notes'
        ]);
        $header['cashier_id'] = auth()->id();
        $header['cashier_name'] = auth()->user()->name;

        $invoice = $this->service.create(
            $header, 
            $request->input('items'), 
            $request->boolean('update_product_prices')
        );

        return redirect()->route('dashboard.purchase-invoices.show', $invoice->id)
            ->with('success', 'Purchase recorded successfully.');
    }

    public function show(PurchaseInvoice $purchaseInvoice): View
    {
        Gate::authorize('purchase_invoice.view');
        $purchaseInvoice->load(['items', 'supplier', 'cashier']);
        return view('dashboard.purchase_invoices.show', compact('purchaseInvoice'));
    }

    /**
     * Custom action: Settle debt with supplier.
     */
    public function paySupplier(Request $request, PurchaseInvoice $purchaseInvoice): RedirectResponse
    {
        Gate::authorize('purchase_invoice.pay_supplier');
        
        $request->validate(['amount' => 'required|numeric|gt:0']);
        
        $this->service.collectPayment($purchaseInvoice, (float) $request->input('amount'));

        return back()->with('success', 'Payment recorded successfully.');
    }

    public function destroy(PurchaseInvoice $purchaseInvoice): RedirectResponse
    {
        Gate::authorize('purchase_invoice.delete');
        $purchaseInvoice->delete();
        return redirect()->route('dashboard.purchase-invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
