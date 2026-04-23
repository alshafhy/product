<?php

namespace App\Http\Controllers;

use App\Models\UnitOfMeasure;
use App\Http\Requests\UnitOfMeasure\StoreUnitOfMeasureRequest;
use App\Http\Requests\UnitOfMeasure\UpdateUnitOfMeasureRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UnitOfMeasureController extends Controller
{
    public function index(): View
    {
        $this->authorize('unit.view');
        $units = UnitOfMeasure::latest()->paginate(20);
        return view('units.index', compact('units'));
    }

    public function create(): View
    {
        $this->authorize('unit.create');
        return view('units.create');
    }

    public function store(StoreUnitOfMeasureRequest $request): RedirectResponse
    {
        $unit = UnitOfMeasure::create($request->validated());
        return redirect()
            ->route('dashboard.units.show', $unit)
            ->with('success', 'تم إنشاء وحدة القياس بنجاح.');
    }

    public function show(UnitOfMeasure $unit): View
    {
        $this->authorize('unit.view');
        return view('units.show', compact('unit'));
    }

    public function edit(UnitOfMeasure $unit): View
    {
        $this->authorize('unit.edit');
        return view('units.edit', compact('unit'));
    }

    public function update(UpdateUnitOfMeasureRequest $request, UnitOfMeasure $unit): RedirectResponse
    {
        $unit->update($request->validated());
        return redirect()
            ->route('dashboard.units.show', $unit)
            ->with('success', 'تم تحديث وحدة القياس بنجاح.');
    }

    public function destroy(UnitOfMeasure $unit): RedirectResponse
    {
        $this->authorize('unit.delete');
        $unit->delete();
        return redirect()
            ->route('dashboard.units.index')
            ->with('success', 'تم حذف وحدة القياس بنجاح.');
    }
}
