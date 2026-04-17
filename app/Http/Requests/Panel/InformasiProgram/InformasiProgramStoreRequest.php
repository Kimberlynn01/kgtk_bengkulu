<?php

namespace App\Http\Requests\Panel\InformasiProgram;

use Illuminate\Foundation\Http\FormRequest;

class InformasiProgramStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'files' => 'required|array|min:1',
            'files.*' => 'required|file|mimes:jpeg,png,jpg,pdf,xls,xlsx|max:2048',
        ];
    }
}
