<?php

namespace App\Http\Controllers;

use App\Models\UnitOfMeasure;
use App\Http\Requests\UnitOfMeasure\StoreUnitOfMeasureRequest;
use App\Http\Requests\UnitOfMeasure\UpdateUnitOfMeasureRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class UnitOfMeasureController extends Controller
{
    public function index(): View
    {
        Gate::authorize('unit.view');
        $units = UnitOfMeasure::latest()->paginate(20);
        return view('dashboard.units.index', compact('units'));
    }

    public function create(): View
    {
        Gate::authorize('unit.create');
        return view('dashboard.units.create');
    }

    public function store(StoreUnitOfMeasureRequest $request): RedirectResponse
    {
        UnitOfMeasure::create($request->validated());
        return redirect()->route('units.index')->with('success', 'Unit created successfully.');
    }

    public function show(UnitOfMeasure $unitOfMeasure): View
    {
        Gate::authorize('unit.view');
        return view('dashboard.units.show', compact('unitOfMeasure'));
    }

    public function edit(UnitOfMeasure $unitOfMeasure): View
    {
        Gate::authorize('unit.edit');
        return view('dashboard.units.edit', compact('unitOfMeasure'));
    }

    public function update(UpdateUnitOfMeasureRequest $request, UnitOfMeasure $unitOfMeasure): RedirectResponse
    {
        $unitOfMeasure->update($request->validated());
        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy(UnitOfMeasure $unitOfMeasure): RedirectResponse
    {
        Gate::authorize('unit.delete');
        $unitOfMeasure->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}
