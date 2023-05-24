<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class ChangeEmailAddressRequestFactory extends RequestFactory
{
  public function definition(): array
  {
    return [
      'email' => fake()->safeEmail(),
      'password' => fake()->password()
    ];
  }
}
