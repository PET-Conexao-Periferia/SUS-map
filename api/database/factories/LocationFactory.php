<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //faixa de Igarassu, PE (aproximadamente)
        return [
            'latitude' => fake()->latitude(
                -7.8341 - 0.1,
                -7.8341 + 0.1
            ),
            'longitude' => fake()->longitude(
                -34.9064 - 0.1,
                -34.9064 + 0.1
            ),
        ];
    }
}
