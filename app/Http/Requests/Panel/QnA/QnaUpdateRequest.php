<?php

namespace App\Http\Requests\Panel\Qna;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QnaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'       => 'required|exists:qnas,id',
            'answer'   => 'sometimes|required',
            'category' => ['sometimes', 'required', Rule::in(['ppg', 'bcks', 'bcps', 'pkgbk', 'pkgsd mbi', 'stem', 'pm/kka', 'ukkj', 'gpk mahir'])],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'       => 'ID QnA wajib disertakan.',
            'id.exists'         => 'Data QnA tidak ditemukan.',
            'answer.required'   => 'Jawaban resmi wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'category.in'       => 'Kategori tidak valid.',
        ];
    }
}