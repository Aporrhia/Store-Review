<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StoreItemSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            'Rackets' => [
                'Wilson'  => ['Blade', 'Pro Staff', 'Clash', 'Ultra', 'Burn'],
                'Babolat' => ['Pure Drive', 'Pure Aero', 'Pure Strike', 'Evo Drive', 'Boost Drive'],
                'Head'    => ['Speed Pro', 'Radical MP', 'Gravity Pro', 'Extreme MP', 'Boom MP'],
                'Yonex'   => ['Ezone', 'Vcore', 'Percept'],
            ],
            'Balls' => [
                'Wilson'  => ['US Open Extra Duty', 'Trinity Pro'],
                'Babolat' => ['Team', 'Gold'],
                'Head'    => ['Tour XT', 'Pro', 'Championship'],
                'Yonex'   => ['Tour', 'Championship'],
            ],
            'Dampeners' => [
                'Wilson'  => ['Roland Garros Dampener 2 Pack', 'Shift Dampener 2 Pack', 'Clash Pro Feel Clash Dampener 2 Pack', 'RF Dampener 2 Pack'],
                'Babolat' => ['Drive Damp x2 Dampener', 'Aero Damp x2 Dampener', 'Custom Dampener Black/Yellow', 'Vamos Rafa Dampener'],
                'Head'    => ['Pro Damp - Black', 'Pro Damp - White', 'Zverev Dampener Blue/Yellow', 'Djokovic Dampener'],
                'Yonex'   => ['Vibration Stopper 5 Dampener Blue', 'Vibration Stopper 5 Dampener Red', 'Vibration Stopper 5 Dampener Yellow', 'Vibration Stopper 5 Dampener Black'],
            ],
            'Overgrips' => [
                'Wilson'  => ['Pro Overgrip 3 Pack White', 'Pro Overgrip 3 Pack Black', 'Pro Overgrip 3 Pack Blade Green', 'Pro Perforated Overgrip 3 Pack White', 'Pro Overgrip Sensation 3 Pack Black'],
                'Babolat' => ['VS Original Overgrips White', 'VS Original Overgrip Black', 'Pro Response Overgrip Black', 'Pro Response Overgrip White'],
                'Head'    => ['Prestige Pro Overgrips 3 Pack White', 'Prestige Pro Overgrips 3 Pack Black', 'Prime Tour Overgrip 3 Pack Orange', 'Prime Tour Overgrip 3 Pack Mint', 'XtremeSoft Overgrips Blue 3 Pack', 'XtremeSoft Overgrips Yellow 3 Pack'],
                'Yonex'   => ['Super Grap Overgrip 3 Pack Pink', 'Super Grap Overgrip 3 Pack Black', 'Super Grap Overgrip 3 Pack White', 'Super Grap Overgrip 3 Pack Green', 'Ultra Thin Overgrip 3 Pack White', 'Moist Super Overgrip Water 3 Pack Green', 'Strong Grap Overgrip Wine 3 Pack Red'],
            ],
            'Base Grips' => [
                'Wilson'  => ['RF Leather Replacement Grip Brown', 'Shock Shield Replacement Grip', 'Dual Pro Performance Replacement Grip', 'Sublime Replacement Grip Black', 'Sublime Replacement Grip White'],
                'Babolat' => ['Syntec Pro Replacement Grip Yellow', 'Syntec Pro Replacement Grip White', 'Natural Leather Grip', 'Syntec Evo Replacement Grip Black', 'Syntec Evo Replacement Grip White'],
                'Head'    => ['HydroSorb Pro Replacement Grip Blue', 'HydroSorb Pro Replacement Grip Black', 'HydroSorb Pro Replacement Grip White', 'HydroSorb Replacement Grip Black', 'HydroSorb Replacement Grip White', 'HydroSorb Comfort Replacement Grip Black', 'HydroSorb Comfort Replacement Grip White'],
                'Yonex'   => ['Synthetic Leather Excel Pro Replacement Grip Black', 'Synthetic Leather Excel Pro Replacement Grip White'],
            ],
        ];

        // Predefined attribute values per category + attribute
        $attributeValues = [
            'Rackets' => [
                'Head Size' => [98, 100],
                'Weight'    => [280, 300, 320],
                'Length'    => [27],
            ],
            'Balls' => [
                'Amount in Pack' => [3, 4, 12],
                'Material'       => ['Felt', 'Rubber'],
                'Color'          => ['Yellow', 'White'],
            ],
            'Dampeners' => [
                'Material' => ['Silicone', 'Rubber'],
                'Color'    => ['Black', 'White', 'Blue'],
                'Weight'   => [2, 3],
            ],
            'Overgrips' => [
                'Material' => ['Synthetic', 'Polyurethane'],
                'Length'   => [1100, 1200],
                'Color'    => ['White', 'Black', 'Green', 'Pink'],
            ],
            'Base Grips' => [
                'Length'   => [1100, 1200],
                'Material' => ['Synthetic', 'Leather'],
                'Color'    => ['Black', 'White', 'Brown'],
            ],
        ];

        foreach ($products as $categoryName => $brands) {

            // Get category_id
            $categoryId = DB::table('categories')->where('name', $categoryName)->value('id');

            foreach ($brands as $brandName => $items) {

                // Get brand_id
                $brandId = DB::table('brands')->where('name', $brandName)->value('id');

                foreach ($items as $item) {

                    // Generate SKU first
                    $sku = strtoupper(Str::slug($brandName . '-' . $item));
                    
                    // Check if image exists for this SKU
                    $imagePath = "images/products/{$sku}.webp";
                    $fullImagePath = public_path($imagePath);
                    
                    // Insert store item
                    $storeItemId = DB::table('store_items')->insertGetId([
                        'title'       => $item,
                        'description' => "High-quality {$categoryName} by {$brandName}, model: {$item}.",
                        'brand_id'    => $brandId,
                        'category_id' => $categoryId,
                        'sku'         => $sku,
                        'image_path'  => file_exists($fullImagePath) ? $imagePath : null,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);

                    // Fetch category-specific attributes
                    $attributeIds = DB::table('category_attribute')
                        ->where('category_id', $categoryId)
                        ->pluck('attribute_id');

                    foreach ($attributeIds as $attrId) {
                        $attr = DB::table('attributes')->where('id', $attrId)->first();

                        // Try to fetch predefined values
                        $allowedValues = $attributeValues[$categoryName][$attr->name] ?? null;

                        if ($allowedValues) {
                            // Pick one predefined value
                            $value = $allowedValues[array_rand($allowedValues)];
                        } else {
                            // Fallback if not defined
                            $value = match($attr->input_type) {
                                'number' => rand(1, 10),
                                'text'   => 'Default',
                                default  => 'N/A',
                            };
                        }

                        // Insert product attribute
                        DB::table('store_item_attributes')->insert([
                            'store_item_id' => $storeItemId,
                            'attribute_id'  => $attrId,
                            'value'         => $value,
                            'created_at'    => now(),
                            'updated_at'    => now(),
                        ]);
                    }
                }
            }
        }
    }
}
