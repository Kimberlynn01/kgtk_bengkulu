<?php

namespace App\Http\Requests\Panel\PerjanjianKerja;

use Illuminate\Foundation\Http\FormRequest;

class PerjanjianKerjaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'required|file|mimes:pdf|max:20480',
        ];
    }
}
