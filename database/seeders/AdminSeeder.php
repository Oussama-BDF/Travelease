<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Oussama Boudafdafa',
            'email' => 'admin@exploremorocco.com',
            'phone_number' => null,
            'address' => null,
        ]);
        $user->assignRole('admin');
    }
}
