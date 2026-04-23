<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Branch;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller
{
    public function index(): View
    {
        Gate::authorize('supplier.view');
        $suppliers = Supplier::with('branch')->latest()->paginate(20);
        return view('dashboard.suppliers.index', compact('suppliers'));
    }

    public function create(): View
    {
        Gate::authorize('supplier.create');
        $branches = Branch::all();
        return view('dashboard.suppliers.create', compact('branches'));
    }

    public function store(StoreSupplierRequest $request): RedirectResponse
    {
        Supplier::create($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function show(Supplier $supplier): View
    {
        Gate::authorize('supplier.view');
        return view('dashboard.suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier): View
    {
        Gate::authorize('supplier.edit');
        $branches = Branch::all();
        return view('dashboard.suppliers.edit', compact('supplier', 'branches'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier): RedirectResponse
    {
        $supplier->update($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        Gate::authorize('supplier.delete');
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
