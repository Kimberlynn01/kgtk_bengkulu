<?php

namespace App\Http\Requests\Panel\DataSasaran;

use Illuminate\Foundation\Http\FormRequest;

class DataSasaranUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'id'          => 'required|exists:data_sasarans,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|mimes:doc,docx,xls,xlsx,pdf|max:20480',
        ];
    }
}
