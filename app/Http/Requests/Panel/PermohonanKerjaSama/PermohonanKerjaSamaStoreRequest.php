<?php

namespace App\Http\Requests\Panel\PermohonanKerjaSama;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanKerjaSamaStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'link' => 'required|url|max:500',
        ];
    }
}
