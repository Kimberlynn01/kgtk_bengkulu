<?php

namespace App\Http\Requests\Panel\Ptk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PtkFieldRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'            => 'nullable|exists:ptk_fields,id',
            'label'         => ['required', 'string', 'max:100', Rule::unique('ptk_fields', 'label')->ignore($this->id)],
            'type'          => 'required|in:text,number,select,date',
            'options'       => 'required_if:type,select|nullable|string',
            'is_required'   => 'nullable|boolean',
            'is_filterable' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'label.required'   => 'Nama field wajib diisi.',
            'label.unique'     => 'Nama field sudah dipakai.',
            'type.required'    => 'Tipe field wajib dipilih.',
            'options.required_if' => 'Isi pilihan (satu per baris) untuk tipe Pilihan.',
        ];
    }
}