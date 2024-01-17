<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->numberBetween(100000000, 999999999), // Genera un número de teléfono aleatorio de 9 dígitos dentro del rango válido.
            'username' => $this->faker->userName,
            'password' => bcrypt('password123'), // Asegúrate de usar contraseñas seguras en un entorno real.
            'rol' => $this->faker->randomElement(['admin', 'user']), // Rol aleatorio.
            'remember_token' => Str::random(10), // Genera un token de recuerdo aleatorio.
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
