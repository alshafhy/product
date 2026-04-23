<?php

namespace App\Http\Controllers;

use App\Models\TreasuryTransaction;
use App\Services\TreasuryService;
use App\Http\Requests\Treasury\TreasuryTransactionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class TreasuryController extends Controller
{
    protected TreasuryService $service;

    public function __construct(TreasuryService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        Gate::authorize('treasury.view');
        $transactions = TreasuryTransaction::with(['branch', 'creator'])->latest()->paginate(20);
        return view('dashboard.treasury.index', compact('transactions'));
    }

    public function deposit(TreasuryTransactionRequest $request): RedirectResponse
    {
        Gate::authorize('treasury.deposit');
        $this->service.deposit($request->validated());
        return back()->with('success', 'Deposit recorded successfully.');
    }

    public function withdraw(TreasuryTransactionRequest $request): RedirectResponse
    {
        Gate::authorize('treasury.withdraw');
        try {
            $this->service.withdraw($request->validated());
        } catch (\Exception $e) {
            return back()->withErrors(['amount' => $e->getMessage()]);
        }
        return back()->with('success', 'Withdrawal recorded successfully.');
    }

    public function expense(TreasuryTransactionRequest $request): RedirectResponse
    {
        Gate::authorize('treasury.expense');
        $this->service.expense($request->validated());
        return back()->with('success', 'Expense recorded successfully.');
    }
}
