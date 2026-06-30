<?php

namespace App\Http\Requests\Panel\PermohonanInformasi;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanInformasiUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'id'            => 'required|exists:permohonan_informasis,id',
            'link' => 'required|url|max:500',
        ];
    }
}
