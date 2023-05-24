<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class RegisterUserRequestFactory extends RequestFactory
{
  public function definition(): array
  {
    $roles = config('auth.roles');
    $password = 'Password@007';

    return [
      'name' => fake()->name(),
      'email' => fake()->unique()->safeEmail(),
      'password' => $password,
      'password_confirmation' => $password,
      'phone' => fake()->e164PhoneNumber(),
      'role' => $roles,
    ];
  }

  public function withRole(string $role): static
  {
    return $this->state(['role' => $role]);
  }

  public function withAddress(): static
  {
    return $this->state([
      'street' => fake()->streetAddress(),
      'city' => fake()->city(),
      'state' => fake()->word(),
      'zip_code' => fake()->postcode(),
      'country' => fake()->country(),
    ]);
  }
}
