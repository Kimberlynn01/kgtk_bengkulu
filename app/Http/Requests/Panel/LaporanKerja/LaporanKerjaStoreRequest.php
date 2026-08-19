<?php

namespace App\Http\Requests\Panel\LaporanKerja;

use Illuminate\Foundation\Http\FormRequest;

class LaporanKerjaStoreRequest extends FormRequest
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
