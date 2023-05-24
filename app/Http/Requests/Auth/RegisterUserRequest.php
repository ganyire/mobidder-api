<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', Password::defaults(), 'confirmed'],
            'password_confirmation' => 'required',
            'phone' => 'sometimes|max:255',
            'role' => 'required|max:255|in:super-admin,vendor,customer,vendor-admin',
            'street' => 'sometimes',
            'city' => 'required_with:street',
            'state' => 'sometimes',
            'zip_code' => 'sometimes',
            'country' => 'required_with:street',
        ];
    }

    /**
     * Request parameter descriptions and examples for OpenAPI/Swagger.
     * 
     * @return array<string, array<string, string>>
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The name of the user',
                'example' => fake()->name(),
            ],
            'email' => [
                'description' => 'The email of the user',
                'example' => fake()->email(),
            ],
            'password' => [
                'description' => 'The password of the user',
                'example' => 'Lenny@007',
            ],
            'phone' => [
                'description' => 'The phone number of the user',
                'example' => fake()->e164PhoneNumber(),
            ],
            'role' => [
                'description' => 'The role of the user',
                'example' => 'vendor-admin',
            ],
            'password_confirmation' => [
                'description' => 'The password confirmation of the user',
                'example' => 'Lenny@007',
            ],
            'street' => [
                'description' => 'The street of the user',
                'example' => '1234 Main St',
            ],
            'city' => [
                'description' => 'The city of the user',
                'example' => 'Nairobi',
            ],
            'state' => [
                'description' => 'The state of the user',
                'example' => 'Nairobi',
            ],
            'zip_code' => [
                'description' => 'The zip code of the user',
                'example' => '00100',
            ],
            'country' => [
                'description' => 'The country of the user',
                'example' => 'Kenya',
            ],
        ];
    }
}
