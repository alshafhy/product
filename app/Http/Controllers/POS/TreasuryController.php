<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Resources\TreasuryResource;
use App\Models\TreasuryTransaction;
use App\Services\TreasuryService;
use Illuminate\Http\Request;

class TreasuryController extends Controller
{
    private TreasuryService $service;

    public function __construct(TreasuryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $this->authorize('treasury.view');
        $branchId = $request->query('branch_id', auth()->user()->branch_id);
        
        return response()->json([
            'balance' => $this->service->getBalance($branchId),
            'transactions' => TreasuryResource::collection(
                TreasuryTransaction::where('branch_id', $branchId)->latest()->paginate()
            )
        ]);
    }

    public function deposit(Request $request)
    {
        $this->authorize('treasury.deposit');
        $data = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string',
        ]);
        
        $data['user_id'] = auth()->id();
        $data['created_by'] = auth()->id();
        
        return new TreasuryResource($this->service->deposit($data));
    }

    public function withdraw(Request $request)
    {
        $this->authorize('treasury.withdraw');
        $data = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:withdrawal,expense',
            'description' => 'required|string',
        ]);
        
        $data['user_id'] = auth()->id();
        $data['created_by'] = auth()->id();
        
        return new TreasuryResource($this->service->withdraw($data));
    }
}
