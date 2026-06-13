<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategoryProductSeeder::class,
            FaqSeeder::class,
        ]);

        $user = User::firstOrCreate(['email' => 'test@example.com'], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);

        $user->roles()->firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'description' => 'Administrator with full access']
        );
    }
}
