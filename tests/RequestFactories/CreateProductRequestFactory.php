<?php

namespace Tests\RequestFactories;

use App\Models\Category;
use Worksome\RequestFactories\RequestFactory;

class CreateProductRequestFactory extends RequestFactory
{
  public function definition(): array
  {
    return [
      'name' => fake()->word(),
      'description' => fake()->sentence(),
      'average_price' => fake()->randomFloat(2, 1, 1000),
      'unit_of_measure' => collect([
        'kg', 'ml', 'litres', 'cm', 'm', 'gm'
      ])->random(),
      'category_id' => fake()->uuid()
    ];
  }
}
