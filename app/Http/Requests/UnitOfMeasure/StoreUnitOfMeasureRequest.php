<?php

namespace App\Http\Requests\UnitOfMeasure;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreUnitOfMeasureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('unit.create');
    }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:255'],
            'ar_name'      => ['nullable', 'string', 'max:255'],
            'abbreviation' => ['nullable', 'string', 'max:50'],
            'is_active'    => ['boolean'],
        ];
    }
}
