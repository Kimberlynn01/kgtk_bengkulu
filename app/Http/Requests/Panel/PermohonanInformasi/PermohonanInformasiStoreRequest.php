<?php

namespace App\Http\Requests\Panel\PermohonanInformasi;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanInformasiStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'link' => 'required|url|max:500',
        ];
    }
}
