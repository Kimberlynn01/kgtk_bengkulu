<?php

namespace App\Http\Requests\Panel\Navbar;

use Illuminate\Foundation\Http\FormRequest;

class NavbarMenuUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'        => 'required|exists:navbar_menus,id',
            'name'      => 'required|string|max:100',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama menu wajib diisi.',
        ];
    }
}