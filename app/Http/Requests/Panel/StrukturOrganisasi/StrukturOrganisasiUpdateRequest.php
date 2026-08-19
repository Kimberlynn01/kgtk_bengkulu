<?php

namespace App\Http\Requests\Panel\StrukturOrganisasi;

use Illuminate\Foundation\Http\FormRequest;

class StrukturOrganisasiUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'id'    => 'required|exists:struktur_organisasis,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
        ];
    }
}
