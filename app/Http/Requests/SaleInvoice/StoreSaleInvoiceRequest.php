<?php

namespace App\Http\Requests\SaleInvoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreSaleInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('sale_invoice.create');
    }

    public function rules(): array
    {
        return [
            'branch_id'       => ['required', 'exists:branches,id'],
            'customer_id'     => ['nullable', 'exists:customers,id'],
            'invoice_date'    => ['nullable', 'date'],
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
            'discount_type'   => ['required', 'string', 'in:fixed,percent'],
            'payment_type'    => ['required', 'string', 'in:cash,credit,partial'],
            'paid_amount'     => ['nullable', 'numeric', 'min:0'],
            'notes'           => ['nullable', 'string'],
            'items'           => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity'   => ['required', 'numeric', 'gt:0'],
            'items.*.sell_price' => ['required', 'numeric', 'min:0'],
            'items.*.buy_price'  => ['nullable', 'numeric', 'min:0'],
            'items.*.price_type' => ['nullable', 'string', 'in:one,two,three'],
        ];
    }
}
