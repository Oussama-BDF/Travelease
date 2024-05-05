<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);

        // Create permissions
        $permission1 = Permission::create(['name' => 'create trip']);
        $permission2 = Permission::create(['name' => 'edit trip']);
        $permission3 = Permission::create(['name' => 'delete trip']);
        $permission4 = Permission::create(['name' => 'book trip']);

        // Assign permissions to roles
        $role1->givePermissionTo($permission1, $permission2, $permission3);
        $role2->givePermissionTo($permission4);
    }
}
