<?php

namespace App\Http\Requests\Panel\Consultation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConsultationSessionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:150'],
            'slug'        => ['nullable', 'string', 'max:150', Rule::unique('consultation_sessions', 'slug')],
            'description' => ['required', 'string'],
            'gmeet_link'  => ['required', 'url', 'max:255'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Judul wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'gmeet_link.required'  => 'Link Google Meet wajib diisi.',
            'gmeet_link.url'       => 'Link Google Meet harus berupa URL yang valid.',
            'image.image'          => 'File harus berupa gambar.',
            'image.max'            => 'Ukuran gambar maksimal 20MB.',
        ];
    }
}