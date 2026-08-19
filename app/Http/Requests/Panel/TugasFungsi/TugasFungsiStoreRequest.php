<?php

namespace App\Http\Requests\Panel\TugasFungsi;

use Illuminate\Foundation\Http\FormRequest;

class TugasFungsiStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
        ];
    }
}
