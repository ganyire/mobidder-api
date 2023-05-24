<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SendPasswordResetCodeRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'email.exists' => 'The email you entered does not exist in our database.'
        ];
    }

    /**
     * Get the body parameters for the request.
     */
    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'The email address of the user',
                'example' => fake()->safeEmail()
            ]
        ];
    }
}
