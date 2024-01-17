<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));
        return [
            'name' => $this->faker->word, // Genera una palabra aleatoria.
            'image' => $faker->imageUrl(), // Genera una URL de imagen falsa.
            'state' => $this->faker->randomElement(['activo', 'inactivo']), // Estado activo o inactivo de manera aleatoria.
            'delete' => $this->faker->randomElement([true, false]),
        ];
    }
}
