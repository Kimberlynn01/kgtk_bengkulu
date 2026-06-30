<?php

namespace App\Http\Requests\Panel\Qna;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QnaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Set true agar request diizinkan lolos ke proses validasi
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'instansi' => 'required|string|max:255',
            'phone'    => 'required|numeric',
            'category' => ['required', Rule::in(['ppg', 'bcks', 'bcps', 'pkgbk', 'pkgsd mbi', 'stem', 'pm/kka', 'ukkj', 'gpk mahir'])],
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
            'category.required' => 'Kategori wajib dipilih.',
            'category.in'       => 'Kategori yang dipilih tidak valid.',
            'question.required' => 'Isi pertanyaan wajib diisi.',
        ];
    }
}