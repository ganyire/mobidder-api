<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'email' => fake()->companyEmail(),
            'phone' => fake()->e164PhoneNumber(),
            'website' => fake()->url(),
            'logo' => fake()->imageUrl(),
            'user_id' => User::factory()->addRole('vendor-admin'),
        ];
    }

    public function withAddress(): static
    {
        return $this->afterCreating(function (Business $business) {
            $business->address()->create([
                'street' => fake()->streetAddress(),
                'city' => fake()->city(),
                'state' => fake()->word(),
                'zip_code' => fake()->postcode(),
                'country' => fake()->country(),
            ]);
        });
    }
}
