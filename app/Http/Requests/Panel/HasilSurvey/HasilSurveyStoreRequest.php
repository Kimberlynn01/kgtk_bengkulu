<?php

namespace App\Http\Requests\Panel\HasilSurvey;

use Illuminate\Foundation\Http\FormRequest;

class HasilSurveyStoreRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
        ];
    }
}
