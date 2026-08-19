<?php

namespace App\Http\Requests\Panel\QnA;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QnaCategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'   => 'required|exists:qna_categories,id',
            'name' => ['required', 'string', 'max:100', Rule::unique('qna_categories', 'name')->ignore($this->id)],
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