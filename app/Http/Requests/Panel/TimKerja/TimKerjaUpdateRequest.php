<?php

namespace App\Http\Requests\Panel\TimKerja;

use Illuminate\Foundation\Http\FormRequest;

class TimKerjaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:tim_kerjas,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'exists:tim_kerja_images,id',
        ];
    }
}
