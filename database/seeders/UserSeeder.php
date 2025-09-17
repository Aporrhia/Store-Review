<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user with level 2
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'level' => 2, // Admin level
            'email_verified_at' => now(),
        ]);

        // Create test user with level 1 (regular user)
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'level' => 1, // Regular user level
            'email_verified_at' => now(),
        ]);

        // Create specific users with level 1 (regular users)
        $specificUsers = [
            'Benji Coleman',
            'Austin Steiner', 
            'Ludwig Meyer',
            'Molly Presley',
            'Trent Sherman',
            'Marco Barone',
            'Carl Bundy'
        ];

        foreach ($specificUsers as $name) {
            User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'password' => Hash::make('password'),
                'level' => 1, // Regular user level
                'email_verified_at' => now(),
            ]);
        }
    }
}