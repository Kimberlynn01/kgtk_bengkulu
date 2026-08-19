<?php

namespace App\Http\Requests\Panel\RencanaStrategis;

use Illuminate\Foundation\Http\FormRequest;

class RencanaStrategisUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:rencana_strategis,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:20480',
        ];
    }
}
