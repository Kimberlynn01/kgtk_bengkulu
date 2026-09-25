<?php

namespace App\Http\Requests\Panel\PPID\TugasFungsi;

use Illuminate\Foundation\Http\FormRequest;

class PpidTugasFungsiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'          => 'required|exists:ppid_tugas_fungsis,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,heic|max:20480',
        ];
    }
}