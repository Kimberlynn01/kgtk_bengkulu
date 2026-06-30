<?php

namespace App\Http\Requests\Panel\DataSasaran;

use Illuminate\Foundation\Http\FormRequest;

class DataSasaranStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|mimes:doc,docx,xls,xlsx,pdf|max:20480',
        ];
    }
}
