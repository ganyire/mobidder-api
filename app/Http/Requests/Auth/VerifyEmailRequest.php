<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
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
            'email_verification_token' => ['required', 'string', 'size:6', 'exists:users,email_verification_token'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'email_verification_token' => [
                'description' => 'Email verification token',
                'example' => '123456',
            ],
        ];
    }
}
