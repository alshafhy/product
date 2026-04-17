<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleInvoiceRequest;
use App\Http\Resources\SaleInvoiceResource;
use App\Models\SaleInvoice;
use App\Services\SaleInvoiceService;
use Illuminate\Http\Request;

class SaleInvoiceController extends Controller
{
    private SaleInvoiceService $service;

    public function __construct(SaleInvoiceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('sale_invoice.view');
        return SaleInvoiceResource::collection(SaleInvoice::with('customer')->paginate());
    }

    public function store(StoreSaleInvoiceRequest $request)
    {
        // Permission check is inside StoreSaleInvoiceRequest::authorize()
        $data = $request->except('items');
        $data['user_id'] = auth()->id();
        $data['branch_id'] = $data['branch_id'] ?? auth()->user()->branch_id;
        
        $invoice = $this->service->createInvoice($data, $request->items);
        
        return new SaleInvoiceResource($invoice->load('items'));
    }

    public function show(SaleInvoice $saleInvoice)
    {
        $this->authorize('sale_invoice.view');
        return new SaleInvoiceResource($saleInvoice->load('items', 'customer'));
    }

    public function void(SaleInvoice $saleInvoice)
    {
        $this->authorize('sale_invoice.void');
        // Logic for voiding would be in the service
        return response()->json(['message' => 'Voiding not fully implemented in service yet.']);
    }
}
