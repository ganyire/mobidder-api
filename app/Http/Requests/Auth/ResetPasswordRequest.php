<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' =>  ['required', Password::defaults(), 'confirmed'],
            'password_confirmation' => ['required', Password::defaults(),],
            'token' => 'required|exists:password_reset_tokens,token',
        ];
    }

    public function bodyParameters(): array
    {
        $password = fake()->password();
        return [
            'email' => [
                'description' => 'Email',
                'example' => fake()->unique()->safeEmail(),
            ],
            'password' => [
                'description' => 'Password',
                'example' => $password,
            ],
            'password_confirmation' => [
                'description' => 'Password confirmation',
                'example' => $password,
            ],
            'token' => [
                'description' => 'Token that you received in your email',
                'example' => fake()->uuid(),
            ],
        ];
    }
}
