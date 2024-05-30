<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 12; $i++) { 
            \App\Models\Image::create([
                'path' => 'trip/' . $i+1 .'.jpg',
                'thumbnail' => 'trip/thumbnails/' . $i+1 .'.jpg',
                'trip_id' => $i+1, // 1->12
            ]);
        }
    }
}
