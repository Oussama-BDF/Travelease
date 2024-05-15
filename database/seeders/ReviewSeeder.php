<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 review the 5 first users with rating 5
        for ($i=0; $i < 5; $i++) { 
            $user = \App\Models\Review::factory()->create([
                'review' => fake()->paragraph(),
                'rating' => 5,
                'user_id' => $i+2, // fake()->randomElement([2,3,4,5,6]),
            ]);
        }

        \App\Models\Review::factory(30)->create();
    }
}
