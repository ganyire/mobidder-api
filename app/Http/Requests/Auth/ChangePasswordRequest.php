<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'oldPassword' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'password_confirmation' => ['required', Password::defaults(),],
        ];
    }

    public function messages(): array
    {
        return [
            'oldPassword.current_password' => 'The old password is incorrect',
            'odlPassword.required' => 'The old password is required',
            'password.required' => 'The new password is required',
            'password.confirmed' => 'The new password confirmation does not match',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'oldPassword' => [
                'description' => 'The old password',
                'example' => 'Oldpassword10'
            ],
            'password' => [
                'description' => 'The new password',
                'example' => 'Newpassword10'
            ],
            'password_confirmation' => [
                'description' => 'The new password confirmation',
                'example' => 'Newpassword10'
            ]
        ];
    }
}
