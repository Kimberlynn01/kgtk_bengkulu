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
            'name'        => ['required', 'string', 'max:100', Rule::unique('qna_categories', 'name')],
            'description' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah ada.',
            'description.required' => 'Deskripsi kategori wajib diisi.',
            'description.max' => 'Deskripsi kategori tidak boleh lebih dari 255 karakter.',
            
        ];
    }
}