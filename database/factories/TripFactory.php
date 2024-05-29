<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'destination' => fake()->city(),
            'start_at' => fake()->dateTimeBetween('now', '+1 week')->format('Y-m-d'),
            'end_at' => fake()->dateTimeBetween('+2 weeks', '3 weeks')->format('Y-m-d'),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 100, 9999),
            'accommodation' => fake()->randomElement(['Hotel', 'Hostel', 'Apartment', 'Villa', 'Condo', 'Beach house', 'Chalet', 'Cottage']),
            'transport_id' => fake()->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
        ];
    }
}
