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
        $categories = ['Rackets', 'Balls', 'Dampeners', 'Overgrips', 'Base Grips', 'Lead Tapes'];
        $brands = ['Wilson', 'Babolat', 'Head', 'Yonex'];

        for ($i = 1; $i <= 20; $i++) {
            StoreItem::create([
                'user_id' => 1,
                'title' => "Product $i",
                'description' => "Description for Product $i.",
                'sku' => "SKU$i",
                'price' => rand(5, 250),
                'category' => $categories[array_rand($categories)],
                'brand' => $brands[array_rand($brands)],
            ]);
        }
    }
}
