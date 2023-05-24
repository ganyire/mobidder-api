<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangeEmailAddressRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|current_password',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'New email address to set',
                'example' => fake()->safeEmail()
            ],
            'password' => [
                'description' => "User's current password",
                'example' => fake()->password()
            ]
        ];
    }
}
