<?php

namespace App\Http\Controllers;

use App\Models\TreasuryTransaction;
use App\Services\TreasuryService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TreasuryController extends Controller
{
    public function __construct(
        private readonly TreasuryService $treasuryService
    ) {}

    public function index(Request $request): View
    {
        $this->authorize('treasury.view');

        $branchId     = auth()->user()->branch_id;
        $transactions = TreasuryTransaction::forBranch($branchId)
            ->with('createdBy')
            ->when($request->type, fn($q, $t) => $q->byType($t))
            ->when(
                $request->date_from && $request->date_to,
                fn($q) => $q->dateBetween($request->date_from, $request->date_to)
            )
            ->orderByDesc('id')
            ->paginate(25);

        $currentBalance = $this->treasuryService->currentBalance($branchId);

        return view('treasury.index', compact('transactions', 'currentBalance'));
    }

    public function deposit(Request $request): RedirectResponse
    {
        $this->authorize('treasury.deposit');

        $validated = $request->validate([
            'amount'           => 'required|numeric|min:0.0001',
            'notes'            => 'nullable|string|max:500',
            'transaction_date' => 'required|date',
        ]);

        $this->treasuryService->deposit(array_merge($validated, [
            'branch_id'  => auth()->user()->branch_id,
            'created_by' => auth()->id(),
        ]));

        return redirect()
            ->route('dashboard.treasury.index')
            ->with('success', 'تم إيداع المبلغ في الخزينة بنجاح.');
    }

    public function withdraw(Request $request): RedirectResponse
    {
        $this->authorize('treasury.withdraw');

        $validated = $request->validate([
            'amount'           => 'required|numeric|min:0.0001',
            'notes'            => 'nullable|string|max:500',
            'transaction_date' => 'required|date',
        ]);

        try {
            $this->treasuryService->withdraw(array_merge($validated, [
                'branch_id'  => auth()->user()->branch_id,
                'created_by' => auth()->id(),
            ]));
        } catch (\RuntimeException $e) {
            return back()->withErrors(['amount' => $e->getMessage()]);
        }

        return redirect()
            ->route('dashboard.treasury.index')
            ->with('success', 'تم سحب المبلغ من الخزينة بنجاح.');
    }

    public function expense(Request $request): RedirectResponse
    {
        $this->authorize('treasury.expense');

        $validated = $request->validate([
            'amount'           => 'required|numeric|min:0.0001',
            'notes'            => 'required|string|max:500',
            'transaction_date' => 'required|date',
        ]);

        try {
            $this->treasuryService->expense(array_merge($validated, [
                'branch_id'  => auth()->user()->branch_id,
                'created_by' => auth()->id(),
            ]));
        } catch (\RuntimeException $e) {
            return back()->withErrors(['amount' => $e->getMessage()]);
        }

        return redirect()
            ->route('dashboard.treasury.index')
            ->with('success', 'تم تسجيل المصروف بنجاح.');
    }
}
