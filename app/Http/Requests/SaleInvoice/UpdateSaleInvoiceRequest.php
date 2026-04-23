<?php

namespace App\Http\Requests\SaleInvoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSaleInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('sale_invoice.edit');
    }

    public function rules(): array
    {
        return [
            'notes' => ['nullable', 'string'],
            // Invoices usually shouldn't be fully editable to maintain stock integrity.
            // Only allow updating metadata.
        ];
    }
}
