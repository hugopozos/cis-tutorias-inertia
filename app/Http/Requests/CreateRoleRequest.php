<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRoleRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique(Role::class, 'name')],
            'guard_name' => ['required', 'string', 'max:5', Rule::in(['web', 'admin'])],
            'permissions' => ['required', 'array'],
            'permissions.*.id' => ['required', 'integer', Rule::exists('permissions', 'id')],
            'permissions.*.name' => ['required', 'string'],
            'permissions.*.guard_name' => ['required', 'string', Rule::in(['web', 'admin'])],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'guard_name' => 'guard',
            'permissions' => 'permisos',
        ];
    }
}
