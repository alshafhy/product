<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseInvoiceRequest;
use App\Http\Resources\PurchaseInvoiceResource;
use App\Models\PurchaseInvoice;
use App\Services\PurchaseInvoiceService;

class PurchaseInvoiceController extends Controller
{
    private PurchaseInvoiceService $service;

    public function __construct(PurchaseInvoiceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('purchase_invoice.view');
        return PurchaseInvoiceResource::collection(PurchaseInvoice::with('supplier')->paginate());
    }

    public function store(StorePurchaseInvoiceRequest $request)
    {
        $data = $request->except('items');
        $data['user_id'] = auth()->id();
        $data['branch_id'] = $data['branch_id'] ?? auth()->user()->branch_id;
        
        $invoice = $this->service->createInvoice($data, $request->items);
        
        return new PurchaseInvoiceResource($invoice->load('items'));
    }

    public function show(PurchaseInvoice $purchaseInvoice)
    {
        $this->authorize('purchase_invoice.view');
        return new PurchaseInvoiceResource($purchaseInvoice->load('items', 'supplier'));
    }
}
