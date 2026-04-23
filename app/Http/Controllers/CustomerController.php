<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Branch;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function index(): View
    {
        Gate::authorize('customer.view');
        $customers = Customer::with('branch')->latest()->paginate(20);
        return view('dashboard.customers.index', compact('customers'));
    }

    public function create(): View
    {
        Gate::authorize('customer.create');
        $branches = Branch::all();
        return view('dashboard.customers.create', compact('branches'));
    }

    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        Customer::create($request->validated());
        return redirect()->route('dashboard.customers.index')->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer): View
    {
        Gate::authorize('customer.view');
        return view('dashboard.customers.show', compact('customer'));
    }

    public function edit(Customer $customer): View
    {
        Gate::authorize('customer.edit');
        $branches = Branch::all();
        return view('dashboard.customers.edit', compact('customer', 'branches'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());
        return redirect()->route('dashboard.customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        Gate::authorize('customer.delete');
        $customer->delete();
        return redirect()->route('dashboard.customers.index')->with('success', 'Customer deleted successfully.');
    }
}
