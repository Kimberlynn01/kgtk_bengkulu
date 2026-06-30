<?php

namespace App\Http\Requests\Panel\PermohonanNarasumber;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanNarasumberStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'link' => 'required|max:500',
        ];
    }
}
