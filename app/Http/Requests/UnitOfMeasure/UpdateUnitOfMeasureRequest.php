<?php

namespace App\Http\Requests\UnitOfMeasure;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateUnitOfMeasureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('unit.edit');
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
