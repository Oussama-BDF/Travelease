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
            'description' => fake()->randomElement([null, 'Experience the thrill of adventure with our curated trips. From exotic destinations to cultural wonders, each journey promises unforgettable memories. Book your next getaway today!']),
            'price' => fake()->randomFloat(2, 100, 400),
            'accommodation' => fake()->randomElement(['Hotel', 'Hostel', 'Apartment', 'Villa', 'Condo', 'Beach house', 'Chalet', 'Cottage']),
            'transport_id' => rand(1, 12),
            'max_travelers' => rand(5, 20),
        ];
    }
}
