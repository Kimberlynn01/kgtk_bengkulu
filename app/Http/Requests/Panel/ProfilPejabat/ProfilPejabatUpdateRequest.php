<?php

namespace App\Http\Requests\Panel\ProfilPejabat;

use Illuminate\Foundation\Http\FormRequest;

class ProfilPejabatUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:profil_pejabats,id',
            'title' => 'required|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'exists:profil_pejabat_images,id',
        ];
    }
}
