<?php

namespace App\Http\Requests\Treasury;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class TreasuryTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Dynamically check permission based on route/action if needed
        return true; 
    }

    public function rules(): array
    {
        return [
            'branch_id'        => ['required', 'exists:branches,id'],
            'amount'           => ['required', 'numeric', 'gt:0'],
            'transaction_date' => ['nullable', 'date'],
            'notes'            => ['nullable', 'string'],
        ];
    }
}
