<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'adults_number' => '1',
            'children_number' => '0',
            'emergency_contact' => '+212 606060606',
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'payment_token' => (string) Str::uuid(),
            'user_id' => rand(2, 36),
        ];
    }
}
