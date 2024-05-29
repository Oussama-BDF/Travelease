<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $names = ['Airplane', 'Car', 'Motor Cycle', 'Train', 'Boat', 'Ferry', 'Bicycles', 'Electric Bike', 'Bus', 'Tram', 'Subway', 'walk'];
        // Create 12 transports
        for ($i=0; $i < 1; $i++) { 
            $user = \App\Models\Transport::create([
                'name' => $names[$i],
            ]);
        }
    }
}
