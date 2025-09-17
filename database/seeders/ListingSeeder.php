<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $storeItems = DB::table('store_items')->get();
        $users = DB::table('users')->pluck('id')->toArray();
        $faker = \Faker\Factory::create();

        if (empty($users)) return;
        
        foreach ($storeItems as $item) {
            // Each product gets 1-3 listings
            $listingCount = rand(1, 3);
            for ($i = 0; $i < $listingCount; $i++) {
                // Randomly assign to different users
                $randomUserId = $users[array_rand($users)];
                
                DB::table('listings')->insert([
                    'store_item_id' => $item->id,
                    'user_id'      => $randomUserId,
                    'price'        => $faker->randomFloat(2, 10, 300),
                    'condition'    => $faker->randomElement(['new', 'used', 'refurbished']),
                    'comment'      => $faker->optional()->sentence(),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }
    }
}
