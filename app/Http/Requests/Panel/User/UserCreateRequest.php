<?php

namespace App\Http\Requests\Panel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return rbacCheck('pengguna', 2);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the schema from the SQL Server configuration
        $schema = config('database.connections.sqlsrv.schema');

        return [
            'name' => 'required',
            'email' => [
                'required',
                // Rule::unique("$schema.users", 'email'),
            ],
            'password' => 'required|min:5',
            'confirmation_password' => 'required|same:password'
        ];
    }
}
