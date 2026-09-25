<?php

namespace App\Http\Requests\Panel\PPID\LayananInformasi;

use Illuminate\Foundation\Http\FormRequest;

class PpidLayananInformasiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'           => 'required|exists:ppid_layanan_informasis,id',
            'nama_dokumen' => 'required|string|max:255',
            'tahun'        => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'file'         => 'nullable|file|mimes:docx,pdf|max:20480',
        ];
    }
}