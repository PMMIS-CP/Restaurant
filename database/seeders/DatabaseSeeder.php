<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // کاربر تست
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'phone' => '09123456789',
        ]);

        // Create admin user
        Admin::create([
            'name'     => 'Admin',
            'email'    => 'admin@restaurant.test',
            'password' => Hash::make('1234'),
        ]);

        // فراخوانی سایر Seeders
        $this->call([
            MenuCategorySeeder::class,
            MenuSeeder::class,
            MenuOrganizationalSeeder::class,
            MenuTakeoutSeeder::class,
            ReserveSeeder::class,
        ]);
    }
}
