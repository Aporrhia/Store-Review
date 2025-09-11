<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreItem;

class StoreItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // Ensure a user exists for the listings
    $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();

    $categories = ['Rackets', 'Balls', 'Dampeners', 'Overgrips', 'Base Grips', 'Lead Tapes'];
    $brands = ['Wilson', 'Babolat', 'Head', 'Yonex'];
    $conditions = ['new', 'like new', 'used', 'for parts'];

        foreach (range(1, 20) as $i) {
            $storeItem = StoreItem::create([
                'title' => "Product $i",
                'description' => "Description for Product $i.",
                'sku' => "SKU$i",
                'category' => $categories[array_rand($categories)],
                'brand' => $brands[array_rand($brands)],
            ]);

            \App\Models\Listing::create([
                'store_item_id' => $storeItem->id,
                'user_id' => $user->id,
                'price' => rand(5, 250),
                'condition' => $conditions[array_rand($conditions)],
                'comment' => "Listing for Product $i."
            ]);
        }
    }
}
