<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255',Rule::unique('users')->ignore($this->user)],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password', Password::default()],
        ];
    }
}
