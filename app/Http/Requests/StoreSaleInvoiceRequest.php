<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('sale_invoice.create');
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'nullable|exists:customers,id',
            'invoiced_at' => 'required|date',
            'discount' => 'numeric|min:0',
            'discount_type' => 'required|in:fixed,percentage',
            'paid' => 'numeric|min:0',
            'payment_type' => 'required|string',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:0',
            'items.*.unit_name' => 'required|string',
            'items.*.unit_factor' => 'numeric|min:1',
            'items.*.sell_price' => 'required|numeric|min:0',
            'items.*.price_type' => 'required|string',
        ];
    }
}
