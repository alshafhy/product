<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('purchase_invoice.create');
    }

    public function rules(): array
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
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
            'items.*.buy_price' => 'required|numeric|min:0',
            'items.*.sell_price' => 'required|numeric|min:0',
            'items.*.price_type' => 'required|string',
        ];
    }
}
