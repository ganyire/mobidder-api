<?php

namespace App\Http\Requests\Business;

use App\Traits\Responder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CreateBusinessRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:businesses,email'],
            'phone' => ['sometimes', 'max:255'],
            'website' => ['sometimes', 'url', 'max:255'],
            'logo' => [
                'sometimes',
                'file',
                File::types(['jpg', 'png', 'jpeg', 'webp'])->max(1024),
                // 'dimensions:width=400,height=400'
            ],
            'street' => 'sometimes',
            'city' => 'required_with:street',
            'state' => 'sometimes',
            'zip_code' => 'sometimes',
            'country' => 'required_with:street',

        ];
    }


    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();
        return $this->filterNull($validated);
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Business name',
                'example' => fake()->company(),
            ],
            'email' => [
                'description' => 'Business email',
                'example' => fake()->companyEmail(),
            ],
            'phone' => [
                'description' => 'Business phone number',
                'example' => fake()->phoneNumber(),
            ],
            'website' => [
                'description' => 'Business website',
                'example' => fake()->url(),
            ],
            'logo' => [
                'description' => 'Business logo',
            ],
            'user_id' => [
                'description' => 'Id of the user that owns the business',
                'example' => fake()->uuid(),
            ],
            'street' => [
                'description' => 'Business address: street',
                'example' => fake()->streetAddress(),
            ],
            'city' => [
                'description' => 'Business address: city',
                'example' => fake()->city(),
            ],
            'state' => [
                'description' => 'Business address: state or province',
                'example' => fake()->word(),
            ],
            'zip_code' => [
                'description' => 'Business address: zip code',
                'example' => fake()->postcode(),
            ],
            'country' => [
                'description' => 'Business address: country',
                'example' => fake()->country(),
            ],
        ];
    }
}
