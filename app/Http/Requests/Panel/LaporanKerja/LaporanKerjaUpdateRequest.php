<?php

namespace App\Http\Requests\Panel\LaporanKerja;

use Illuminate\Foundation\Http\FormRequest;

class LaporanKerjaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:laporan_kerjas,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:20480',
        ];
    }
}
