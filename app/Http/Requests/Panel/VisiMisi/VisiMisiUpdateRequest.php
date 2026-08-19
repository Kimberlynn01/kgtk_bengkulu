<?php

namespace App\Http\Requests\Panel\VisiMisi;

use Illuminate\Foundation\Http\FormRequest;

class VisiMisiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:visi_misis,id',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'exists:visi_misi_images,id',
        ];
    }
}
