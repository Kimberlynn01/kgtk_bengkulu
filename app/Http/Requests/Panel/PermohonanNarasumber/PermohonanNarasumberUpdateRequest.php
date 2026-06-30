<?php

namespace App\Http\Requests\Panel\PermohonanNarasumber;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanNarasumberUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'id'            => 'required|exists:permohonan_narasumbers,id',
            'link' => 'required|max:500',
        ];
    }
}
