<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class StoreRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => 'string[]', 'permissions' => 'string[]', 'permissions.*' => 'string[]'])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', Rule::unique('roles')->ignore($this->role)],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ];
    }
}
