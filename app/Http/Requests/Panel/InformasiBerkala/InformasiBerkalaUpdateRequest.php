<?php

namespace App\Http\Requests\Panel\InformasiBerkala;

use Illuminate\Foundation\Http\FormRequest;

class InformasiBerkalaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'           => 'required|exists:informasi_berkalas,id',
            'nama_dokumen' => 'required|string|max:255',
            'tahun'        => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'file'         => 'nullable|file|mimes:docx,pdf|max:20480',
        ];
    }
}