<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private CustomerService $service;

    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('customer.view');
        return CustomerResource::collection($this->service->getAll());
    }

    public function store(Request $request)
    {
        $this->authorize('customer.create');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'opening_balance' => 'numeric',
            'branch_id' => 'required|exists:branches,id',
        ]);

        return new CustomerResource($this->service->create($data));
    }

    public function show(Customer $customer)
    {
        $this->authorize('customer.view');
        return new CustomerResource($customer);
    }

    public function update(Request $request, Customer $customer)
    {
        $this->authorize('customer.edit');
        $this->service->update($customer, $request->all());
        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('customer.delete');
        $this->service->delete($customer);
        return response()->noContent();
    }
}
