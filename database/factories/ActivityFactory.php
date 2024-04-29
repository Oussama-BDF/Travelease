<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Scuba Diving', 'Surfing', 'Skiing', 'Paraliding', 'White-water raffing']),
            'price' => fake()->randomFloat(2, 100, 9999),
            'trip_id' => fake()->randomElement([6]),
        ];
    }
}
