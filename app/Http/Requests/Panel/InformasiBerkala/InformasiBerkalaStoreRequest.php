<?php

namespace App\Http\Requests\Panel\InformasiBerkala;

use Illuminate\Foundation\Http\FormRequest;

class InformasiBerkalaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_dokumen' => 'required|string|max:255',
            'tahun'        => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'file'         => 'required|file|mimes:docx,pdf|max:20480',
        ];
    }
}