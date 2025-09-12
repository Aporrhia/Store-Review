<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Seed users
        if (DB::table('users')->count() === 0) {
            \App\Models\User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Seed store_items
        if (DB::table('store_items')->count() === 0) {
            $this->call(StoreItemSeeder::class);
        }

        // Seed listings
        if (DB::table('listings')->count() === 0) {
            $this->call(ListingSeeder::class);
        }
    }
}
