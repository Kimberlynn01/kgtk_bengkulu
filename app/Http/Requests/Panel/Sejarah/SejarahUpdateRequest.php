<?php

namespace App\Http\Requests\Panel\Sejarah;

use Illuminate\Foundation\Http\FormRequest;

class SejarahUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:sejarahs,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:20480',
        ];
    }
}
