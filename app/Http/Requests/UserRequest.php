<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use JetBrains\PhpStorm\ArrayShape;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => 'string[]', 'username' => 'array', 'email' => 'array', 'password' => 'array', 'role_id' => 'string[]'])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255', Rule::unique('users')->ignore($this->user)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['exclude_if:password,null', Password::default()],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }
}
