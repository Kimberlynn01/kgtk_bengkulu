<?php

namespace App\Http\Requests\Panel\Kemitraan;

use Illuminate\Foundation\Http\FormRequest;

class KemitraanUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:kemitraans,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:doc,docx,ppt,pptx,pdf|max:5120',
            'deleted_files' => 'nullable|array',
            'deleted_files.*' => 'exists:kemitraan_files,id',
        ];
    }
}
