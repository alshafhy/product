<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstallmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('installment.create');
    }

    public function rules(): array
    {
        return [
            'sale_invoice_id' => 'required|exists:sale_invoices,id',
            'count' => 'required|integer|min:1',
            'first_due' => 'required|date|after_or_equal:today',
        ];
    }
}
