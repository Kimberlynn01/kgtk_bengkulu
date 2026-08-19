<?php

namespace App\Http\Requests\Panel\Sejarah;

use Illuminate\Foundation\Http\FormRequest;

class SejarahStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|file|mimes:jpg,jpeg,png,webp|max:20480',
        ];
    }
}
