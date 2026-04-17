<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private SupplierService $service;

    public function __construct(SupplierService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('supplier.view');
        return SupplierResource::collection($this->service->getAll());
    }

    public function store(Request $request)
    {
        $this->authorize('supplier.create');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'opening_balance' => 'numeric',
            'branch_id' => 'required|exists:branches,id',
        ]);

        return new SupplierResource($this->service->create($data));
    }

    public function show(Supplier $supplier)
    {
        $this->authorize('supplier.view');
        return new SupplierResource($supplier);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $this->authorize('supplier.edit');
        $this->service->update($supplier, $request->all());
        return new SupplierResource($supplier);
    }

    public function destroy(Supplier $supplier)
    {
        $this->authorize('supplier.delete');
        $this->service->delete($supplier);
        return response()->noContent();
    }
}
