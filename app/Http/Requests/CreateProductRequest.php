<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class CreateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = Product::$rules;
        $rules['images'] = 'nullable|array';
        $rules['images.*'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        return $rules;
    }
}
