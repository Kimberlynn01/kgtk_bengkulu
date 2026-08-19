<?php

namespace App\Http\Requests\Panel\PerilakuCoreValue;

use Illuminate\Foundation\Http\FormRequest;

class PerilakuCoreValueUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:perilaku_core_values,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:20480',
        ];
    }
}
