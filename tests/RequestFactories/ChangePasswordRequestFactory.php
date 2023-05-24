<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class ChangePasswordRequestFactory extends RequestFactory
{
  public function definition(): array
  {
    $newPassword = fake()->password();
    return [
      'oldPassword' => fake()->password(),
      'password' => $newPassword,
      'password_confirmation' => fn ($attribute) => $attribute['password'],
    ];
  }
}
