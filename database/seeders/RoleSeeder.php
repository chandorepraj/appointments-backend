<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(
            ['name' => 'Admin'],
            [
                'description' => 'Full system access',
                'status' => true,
            ]
        );

        Role::updateOrCreate(
            ['name' => 'Manager'],
            [
                'description' => 'Manage business operations',
                'status' => true,
            ]
        );

        Role::updateOrCreate(
            ['name' => 'Staff'],
            [
                'description' => 'Handle customers and appointments',
                'status' => true,
            ]
        );
    }
}