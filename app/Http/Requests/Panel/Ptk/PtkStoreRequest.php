<?php

namespace App\Http\Requests\Panel\Ptk;

use App\Models\PtkField;
use Illuminate\Foundation\Http\FormRequest;

class PtkStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'jumlah' => 'required|integer|min:0',
        ];

        foreach (PtkField::orderBy('sort_order')->get() as $field) {
            $fieldRules = [$field->is_required ? 'required' : 'nullable'];
            $fieldRules[] = match ($field->type) {
                'number' => 'numeric',
                'date'   => 'date',
                'select' => 'in:' . implode(',', $field->options ?? []),
                default  => 'string',
            };
            $rules["fields.{$field->key}"] = implode('|', $fieldRules);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Field ini wajib diisi.',
        ];
    }
}