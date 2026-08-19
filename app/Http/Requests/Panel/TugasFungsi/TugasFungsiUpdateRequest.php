<?php

namespace App\Http\Requests\Panel\TugasFungsi;

use Illuminate\Foundation\Http\FormRequest;

class TugasFungsiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:tugas_fungsis,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
        ];
    }
}
