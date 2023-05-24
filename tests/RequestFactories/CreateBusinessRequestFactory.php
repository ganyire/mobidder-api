<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class CreateBusinessRequestFactory extends RequestFactory
{
  private $width;
  private $height;

  public function definition(): array
  {
    return [
      'name' => fake()->company(),
      'email' => fake()->companyEmail(),
      'phone' => fake()->e164PhoneNumber(),
      'website' => fake()->url(),
      'logo' => fake()->imageUrl(width: 400, height: 400),
    ];
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

  public function withLogo(string $extension = 'png', string $logoName = 'logo', int $width = 400, int $height = 400): static
  {
    $imageExtension = collect([
      'jpeg', 'jpg', 'png', 'webp'
    ])->random();
    $ext = $extension ?: $imageExtension;
    $imageName = $logoName  . ".{$ext}";

    return $this->state([
      'logo' => $this->image(name: $imageName, width: $width, height: $height)
    ]);
  }
}
