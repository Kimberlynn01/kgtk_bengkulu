<?php

namespace App\Http\Requests\Panel\PPID\InformasiDikecualikan;

use Illuminate\Foundation\Http\FormRequest;

class PpidInformasiDikecualikanUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'           => 'required|exists:ppid_informasi_dikecualikans,id',
            'nama_dokumen' => 'required|string|max:255',
            'tahun'        => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'file'         => 'nullable|file|mimes:docx,pdf|max:20480',
        ];
    }
}