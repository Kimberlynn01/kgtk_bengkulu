<?php

namespace App\Http\Requests\Panel\StrukturOrganisasi;

use Illuminate\Foundation\Http\FormRequest;

class StrukturOrganisasiStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
        ];
    }
}
