<?php

namespace App\Http\Requests\Panel\Kemitraan;

use Illuminate\Foundation\Http\FormRequest;

class KemitraanStoreRequest extends FormRequest
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
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:doc,docx,ppt,pptx,pdf|max:5120',
        ];
    }
}
