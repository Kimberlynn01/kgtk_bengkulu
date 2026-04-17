<?php

namespace App\Http\Requests\Panel\Artikel;

use Illuminate\Foundation\Http\FormRequest;

class ArtikelUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:artikels,id',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'exists:artikel_images,id',
        ];
    }
}
