<?php

namespace App\Http\Requests\Panel\Qna;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QnaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'instansi' => 'required|string|max:255',
            'phone'    => 'required|numeric',
            'category_id' => 'required|exists:qna_categories,id',
            'question' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama penanya wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'instansi.required' => 'Instansi wajib diisi.',
            'phone.required'    => 'No. Telepon wajib diisi.',
            'phone.numeric'     => 'No. Telepon harus berupa angka.',
            'question.required' => 'Isi pertanyaan wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori tidak valid.',
        ];
    }
}