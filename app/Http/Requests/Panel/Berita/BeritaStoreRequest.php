<?php

namespace App\Http\Requests\Panel\Berita;

use Illuminate\Foundation\Http\FormRequest;

class BeritaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
        ];
    }
}
