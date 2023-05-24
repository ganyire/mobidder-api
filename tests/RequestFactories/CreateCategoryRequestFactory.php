<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class CreateCategoryRequestFactory extends RequestFactory
{
  public function definition(): array
  {
    return [
      'name' => fake()->word(),
      'description' => fake()->sentence(),
    ];
  }
}
