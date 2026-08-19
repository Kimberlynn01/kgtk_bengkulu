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
            'category_id' => 'required|exists:qna_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'       => 'ID QnA wajib disertakan.',
            'id.exists'         => 'Data QnA tidak ditemukan.',
            'answer.required'   => 'Jawaban resmi wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori tidak valid.',
        ];
    }
}