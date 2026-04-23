<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('customer.create');
    }

    public function rules(): array
    {
        return [
            'branch_id'    => ['required', 'exists:branches,id'],
            'name'         => ['required', 'string', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:20'],
            'address'      => ['nullable', 'string'],
            'notes'        => ['nullable', 'string'],
            'credit_limit' => ['nullable', 'numeric', 'min:0'],
            'price_type'   => ['required', 'integer', 'in:1,2,3'],
            'is_active'    => ['boolean'],
        ];
    }
}
