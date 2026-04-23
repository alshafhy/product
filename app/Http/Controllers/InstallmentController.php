<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Services\InstallmentService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class InstallmentController extends Controller
{
    protected InstallmentService $service;

    public function __construct(InstallmentService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        Gate::authorize('installment.view');
        $installments = Installment::with(['customer', 'saleInvoice'])->latest()->paginate(20);
        return view('dashboard.installments.index', compact('installments'));
    }

    public function collect(Request $request, Installment $installment): RedirectResponse
    {
        Gate::authorize('installment.collect');
        
        $request->validate(['pay_type' => 'required|string']);
        
        $this->service.collect($installment, $request->only('pay_type'));

        return back()->with('success', 'Installment collected successfully.');
    }

    public function destroy(Installment $installment): RedirectResponse
    {
        Gate::authorize('installment.delete');
        $installment->delete();
        return back()->with('success', 'Installment deleted successfully.');
    }
}
