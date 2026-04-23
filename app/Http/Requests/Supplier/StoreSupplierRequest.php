<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('supplier.create');
    }

    public function rules(): array
    {
        return [
            'branch_id'          => ['required', 'exists:branches,id'],
            'name'               => ['required', 'string', 'max:255'],
            'phone'              => ['nullable', 'string', 'max:20'],
            'address'            => ['nullable', 'string'],
            'notes'              => ['nullable', 'string'],
            'balance_adjustment' => ['nullable', 'numeric'],
            'is_active'          => ['boolean'],
        ];
    }
}
