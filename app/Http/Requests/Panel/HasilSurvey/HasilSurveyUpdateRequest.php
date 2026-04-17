<?php

namespace App\Http\Requests\Panel\HasilSurvey;

use Illuminate\Foundation\Http\FormRequest;

class HasilSurveyUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:hasil_surveys,id',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
