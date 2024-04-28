<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transport>
 */
class TransportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => fake()->randomElement(['AirTravel', 'Road Travel', 'Rail Travel', 'Boating', 'Cycling', 'Walking', 'Public']),
            'name' => fake()->randomElement(['Airplane', 'Car', 'Motor Cycle', 'Train', 'Boat', 'Ferry', 'Bicycles', 'Electric Bike', 'Bus', 'Tram', 'Subway']),
        ];
    }
}
