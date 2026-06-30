<?php

namespace App\Http\Requests\Panel\PermohonanSaranaPrasarana;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanSaranaPrasaranaStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'link' => 'required|url|max:500',
        ];
    }
}
