<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuario admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gimnasio.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);
        // Usuario admin
        User::create([
            'name' => 'admin',
            'email' => 'adminfitmatch@fitmatch.com',
            'password' => bcrypt('fitmatch123'),
            'is_admin' => true,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
