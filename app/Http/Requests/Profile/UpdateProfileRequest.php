<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            // 'email' => 'required|email|max:255|unique:users,email',
            'name' => 'required|max:255',
            'phone' => 'sometimes|max:255',
            'role' => 'sometimes|max:255|in:super-admin,vendor,customer,vendor-admin',
        ];
    }
}
