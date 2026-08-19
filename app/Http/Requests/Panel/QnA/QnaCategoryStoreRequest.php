<?php

namespace App\Http\Requests\Panel\QnA;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QnaCategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('qna_categories', 'name')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah ada.',
        ];
    }
}