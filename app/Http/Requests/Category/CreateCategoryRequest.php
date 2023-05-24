<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories,name',
            'description' => 'sometimes',
        ];
    }


    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();
        return $this->filterNull($validated);
    }

    /**
     * Get the body parameters that apply to the request.
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The name of product category',
                'example' => 'Manufacturing',
            ],
            'description' => [
                'description' => 'The description of the category',
                'example' => fake()->sentence(),
            ],
        ];
    }
}
