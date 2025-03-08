<?php

namespace App\Http\Requests\Panel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return rbacCheck('pengguna', 3);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $schema = config('database.connections.sqlsrv.schema');

        return [
            'name' => 'required',
            'username' => [
                'required',
                // Rule::unique("$schema.users", 'username')
                //     ->ignore($request->id)
            ]
        ];
    }
}
