<?php

namespace App\Http\Requests\Panel\Skm;

use Illuminate\Foundation\Http\FormRequest;

class SkmStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'link' => 'required|url',
        ];
    }
}
