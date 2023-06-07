<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'Lenny@007',
            'phone' => fake()->e164PhoneNumber(),
        ];
    }

    public function addRole(string $role = "customer"): static
    {
        $roles = config("auth.roles");
        $role = $role ?? collect($roles)->random();
        return $this->afterCreating(fn (User $user) => $user->addRole($role));
    }
}
