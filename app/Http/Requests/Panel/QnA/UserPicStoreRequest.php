<?php

namespace App\Http\Requests\Panel\Qna;

use Illuminate\Foundation\Http\FormRequest;

class UserPicStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->input('id');

        return [
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users,username,' . $id,
            'email'    => 'required|email|max:255|unique:users,email,' . $id,
            'password' => $id ? 'nullable|string|min:6' : 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username sudah digunakan.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ];
    }
}