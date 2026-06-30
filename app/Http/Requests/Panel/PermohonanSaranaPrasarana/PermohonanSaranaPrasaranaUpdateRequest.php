<?php

namespace App\Http\Requests\Panel\PermohonanSaranaPrasarana;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanSaranaPrasaranaUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'id'            => 'required|exists:permohonan_sarana_prasaranas,id',
            'link' => 'required|url|max:500',
        ];
    }
}
