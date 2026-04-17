<?php

namespace App\Http\Requests\Panel\Artikel;

use Illuminate\Foundation\Http\FormRequest;

class ArtikelStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // For now, I'll use true since I don't know the exact slug for RBAC yet
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
