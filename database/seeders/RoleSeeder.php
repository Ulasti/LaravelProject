<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'description' => 'Administrator with full access']
        );

        Role::firstOrCreate(
            ['slug' => 'customer'],
            ['name' => 'Customer', 'description' => 'Regular customer']
        );

        $this->command->info('Roles seeded successfully!');
    }
}
