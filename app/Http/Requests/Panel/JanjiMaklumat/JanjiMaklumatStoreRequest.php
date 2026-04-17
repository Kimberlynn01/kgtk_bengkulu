<?php

namespace App\Http\Requests\Panel\JanjiMaklumat;

use Illuminate\Foundation\Http\FormRequest;

class JanjiMaklumatStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
