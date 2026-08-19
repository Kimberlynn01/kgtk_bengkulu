<?php

namespace App\Http\Requests\Panel\JanjiMaklumat;

use Illuminate\Foundation\Http\FormRequest;

class JanjiMaklumatUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:janji_maklumats,id',
            'title' => 'required|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'exists:janji_maklumat_images,id',
        ];
    }
}
