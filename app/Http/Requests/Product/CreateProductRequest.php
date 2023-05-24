<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'average_price' => 'required|numeric',
            'description' => 'sometimes',
            'unit_of_measure' => 'sometimes|max:255',
            'category_id' => 'required|exists:categories,id',

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
                'description' => 'The name of the product',
                'example' => fake()->word(),
            ],
            'average_price' => [
                'description' => 'The average price of the product',
                'example' => 100.00,
            ],
            'description' => [
                'description' => 'The description of the product',
                'example' => fake()->sentence()
            ],
            'unit_of_measure' => [
                'description' => 'The unit of measure of the product',
                'example' => 'kg',
            ],
            'category_id' => [
                'description' => 'The category id of the product',
                'example' => fake()->uuid(),
            ],
        ];
    }
}
