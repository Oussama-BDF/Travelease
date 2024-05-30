<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $destinations = ['Akchour', 'Casablanca', 'Oulidia', 'Rabat', 'Marackech', 'Ourzazate', 'Fes', 'Essaouira', 'Chefchawen', 'Sahara', 'Tangier', 'meknas'];
        // Seeding the Trips
        for ($i=0; $i < 6; $i++) {
            // Generate start_at date
            $startAt = Carbon::parse(fake()->dateTimeBetween('-5 weeks', '-4 weeks')->format('Y-m-d'));
            
            // Calculate created_at as 10 days before start_at
            $createdAt = $startAt->copy()->subDays(10);
            
            // Generate max and current travelers
            $max_travelers = rand(5, 20);
            $current_travelers = intval($max_travelers / 2);

            $trip = \App\Models\Trip::factory()->create([
                'destination' => $destinations[$i],
                'start_at' => $startAt,
                'end_at' => fake()->dateTimeBetween('-4 weeks', '-3 weeks')->format('Y-m-d'),
                'max_travelers' => $max_travelers,
                'current_travelers' => $current_travelers,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Seedig the Bookings of these trips
            for ($j=0; $j < $current_travelers; $j++) { 
                // Generate a random date between created_at and start_at
                $dateBetween = Carbon::parse(fake()->dateTimeBetween($createdAt, $startAt)->format('Y-m-d'));

                \App\Models\Booking::factory()->create([
                    'total_amount' => $trip->price,
                    'trip_id' => $trip->id,
                    'created_at' => $dateBetween,
                    'updated_at' => $dateBetween,
                ]);
            }
        }

        /***************************************************/

        for ($i=6; $i < 12; $i++) {
            // Generate start_at and end_at dates
            $startAt = Carbon::parse(fake()->dateTimeBetween('now', '+7 days')->format('Y-m-d'));

            // Generate max andcurrent travelers
            $max_travelers = rand(5, 20);
            // $current_travelers = fake()->randomElement([intval($max_travelers / 4), $max_travelers]);
            $current_travelers = ($i == 8) ? $max_travelers : intval($max_travelers / 4);

            // Calculate created_at as 10 days before start_at
            $createdAt = $startAt->copy()->subDays(10);

            $trip = \App\Models\Trip::factory()->create([
                'destination' => $destinations[$i],
                'start_at' => $startAt,
                'end_at' => fake()->dateTimeBetween('+8 days', '+11 days')->format('Y-m-d'),
                'max_travelers' => $max_travelers,
                'current_travelers' => $current_travelers,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Seedig the Bookings of these trips
            for ($j=0; $j < $current_travelers; $j++) { 
                // Generate a random date between created_at and start_at
                $dateBetween = Carbon::parse(fake()->dateTimeBetween($createdAt, $startAt)->format('Y-m-d'));

                \App\Models\Booking::factory()->create([
                    'total_amount' => $trip->price,
                    'status' => 'pending',
                    'trip_id' => $trip->id,
                    'created_at' => $dateBetween,
                    'updated_at' => $dateBetween,
                ]);
            }
        }
    }
}
