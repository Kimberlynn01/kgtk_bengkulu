<?php

namespace App\Http\Requests\Panel\PermohonanKerjaSama;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanKerjaSamaUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'id'            => 'required|exists:permohonan_kerja_samas,id',
            'link' => 'required|url|max:500',
        ];
    }
}
