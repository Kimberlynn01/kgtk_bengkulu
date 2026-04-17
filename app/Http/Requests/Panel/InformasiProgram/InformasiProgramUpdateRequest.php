<?php

namespace App\Http\Requests\Panel\InformasiProgram;

use Illuminate\Foundation\Http\FormRequest;

class InformasiProgramUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:informasi_programs,id',
            'title' => 'required|string|max:255',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpeg,png,jpg,pdf,xls,xlsx|max:2048',
            'deleted_files' => 'nullable|array',
            'deleted_files.*' => 'exists:informasi_program_files,id',
        ];
    }
}
