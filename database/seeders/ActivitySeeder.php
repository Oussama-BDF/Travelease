<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 20 activities
        $activities = [
            'Scuba Diving', 'Surfing', 'Skiing', 'Paraliding', 'White-water rafting', //Adventure Sports
            'Hiking', 'Camping', 'Rock climbing', 'Kayaking', 'Zip-lining', // Outdoor Adventures
            'Museums', 'Historical Sites', 'Local Markets', 'Cooking classes', 'Cultural Performances', // Cultural Experiences
            'Spa Retreats', 'Yoga Retreats', 'Beach Days', 'Hot Springs', 'Wellness Workshops', // Relaxation and Wellness
        ];

        for ($i=0; $i < 12; $i++) {
            for ($j=0; $j < rand(1,4); $j++) { 
                \App\Models\Activity::create([
                    'price' => fake()->optional(0.5, 0)->randomFloat(0, 100, 200),
                    'name' => $activities[rand(0,19)],
                    'trip_id' => $i+1,
                ]);
            }
        }

    }
}
