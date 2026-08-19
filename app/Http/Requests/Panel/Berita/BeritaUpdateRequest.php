<?php

namespace App\Http\Requests\Panel\Berita;

use Illuminate\Foundation\Http\FormRequest;

class BeritaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'               => 'required|exists:beritas,id',
            'title'            => 'required|string|max:255',
            'content'          => 'required',
            'images'           => 'nullable|array',
            'images.*'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
            'deleted_images'   => 'nullable|array',
            'deleted_images.*' => 'nullable|integer|exists:berita_images,id',
        ];
    }
}