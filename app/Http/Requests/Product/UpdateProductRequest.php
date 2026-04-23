<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('product.edit');
    }

    public function rules(): array
    {
        return [
            'branch_id'         => ['required', 'exists:branches,id'],
            'category_id'       => ['nullable', 'exists:categories,id'],
            'unit_id'           => ['nullable', 'exists:units_of_measure,id'],
            'code_id'           => ['required', 'string', 'unique:products,code_id,' . $this->product->id],
            'name'              => ['required', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
            'expire_date'       => ['nullable', 'date'],
            'buy_price'         => ['required', 'numeric', 'min:0'],
            'sell_price'        => ['required', 'numeric', 'min:0'],
            'unit2_name'        => ['nullable', 'string'],
            'factor2'           => ['nullable', 'numeric', 'min:0'],
            'buy_price2'        => ['nullable', 'numeric', 'min:0'],
            'sell_price2'       => ['nullable', 'numeric', 'min:0'],
            'sell_price_unit2'  => ['nullable', 'numeric', 'min:0'],
            'unit3_name'        => ['nullable', 'string'],
            'factor3'           => ['nullable', 'numeric', 'min:0'],
            'buy_price3'        => ['nullable', 'numeric', 'min:0'],
            'sell_price3'       => ['nullable', 'numeric', 'min:0'],
            'sell_price_unit3'  => ['nullable', 'numeric', 'min:0'],
            'quantity'          => ['required', 'numeric'],
            'min_quantity'      => ['nullable', 'numeric', 'min:0'],
            'is_active'         => ['boolean'],
        ];
    }
}
