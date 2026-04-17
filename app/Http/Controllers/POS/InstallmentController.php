<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstallmentRequest;
use App\Http\Resources\InstallmentResource;
use App\Models\Installment;
use App\Services\InstallmentService;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    private InstallmentService $service;

    public function __construct(InstallmentService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $this->authorize('installment.view');
        return InstallmentResource::collection(Installment::with('customer', 'saleInvoice')->paginate());
    }

    public function store(StoreInstallmentRequest $request)
    {
        $invoice = \App\Models\SaleInvoice::findOrFail($request->sale_invoice_id);
        $installments = $this->service->generateSchedule($invoice, $request->count, $request->first_due);
        
        return InstallmentResource::collection($installments);
    }

    public function collect(Request $request, Installment $installment)
    {
        $this->authorize('installment.collect');
        $this->service->markAsPaid($installment, now()->toDateString());
        
        return new InstallmentResource($installment);
    }

    public function overdue(Request $request)
    {
        $this->authorize('installment.view');
        $branchId = $request->query('branch_id', auth()->user()->branch_id);
        return InstallmentResource::collection($this->service->getOverdueReport($branchId));
    }
}
