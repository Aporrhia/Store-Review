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
                'Wilson'  => ['Blade 98', 'Pro Staff 97', 'Clash 100', 'Ultra 100', 'Burn 100'],
                'Babolat' => ['Pure Drive', 'Pure Aero', 'Pure Strike', 'Evo Drive', 'Boost Drive'],
                'Head'    => ['Speed Pro', 'Radical MP', 'Gravity Pro', 'Extreme MP', 'Boom MP'],
                'Yonex'   => ['Ezone 100', 'Vcore 95', 'Percept 97', 'Astrel 105', 'Vcore Pro 100'],
            ],
            'Balls' => [
                'Wilson'  => ['US Open Extra Duty', 'Trinity Pro', 'Championship Extra Duty', 'Tour Premier', 'Regular Duty'],
                'Babolat' => ['Team', 'Gold', 'French Open', 'Championship', 'Academy'],
                'Head'    => ['Tour XT', 'Pro', 'Championship', 'ATP', 'No.1'],
                'Yonex'   => ['Tour', 'Championship', 'Pro Tournament', 'Elite', 'Forte'],
            ],
            'Dampeners' => [
                'Wilson'  => ['Pro Feel', 'Shock Trap', 'Shock Shield', 'Pro Overgrip Dampener', 'Trio'],
                'Babolat' => ['Custom Damp', 'Loony Damp', 'Vibrakill', 'Air Damp', 'RVS'],
                'Head'    => ['Smartsorb', 'Djokovic Dampener', 'Pro Damp', 'Zebra', 'Logo'],
                'Yonex'   => ['Vibration Dampener AC166', 'AC165', 'Polyurethane Dampener', 'Sonic Dampener', 'Logo Dampener'],
            ],
            'Overgrips' => [
                'Wilson'  => ['Pro Overgrip', 'Advantage Overgrip', 'Cushion-Aire', 'Pro Sensation', 'Ultra Wrap'],
                'Babolat' => ['Pro Tacky', 'VS Original', 'My Grip', 'Syntec Pro Overgrip', 'Pro Tour'],
                'Head'    => ['Prime Tour', 'Super Comp', 'XtremeSoft', 'Hydrosorb Comfort', 'Prestige Pro'],
                'Yonex'   => ['Super Grap', 'Dry Grap', 'Wave Grap', 'Mesh Grap', 'Tacky Fit'],
            ],
            'Base Grips' => [
                'Wilson'  => ['Feather Thin', 'Shock Shield Hybrid', 'Comfort Hybrid', 'Sponge Grip', 'Cushion-Aire Perforated'],
                'Babolat' => ['Skin Feel', 'Syntec Pro', 'Natural Grip', 'Xcel Gel', 'VS Grip'],
                'Head'    => ['Hydrosorb Pro', 'Hydrosorb Comfort', 'Hydrosorb Tour', 'Hydrosorb XL', 'Leather Tour'],
                'Yonex'   => ['Synthetic Grip AC126', 'Leather Grip', 'Hi Soft Grap', 'Wave Grip', 'Perforated Grip'],
            ],
            'Lead Tapes' => [
                'Wilson'  => ['Pro Lead Tape 1/4"', 'Pro Lead Tape 1/2"', 'Customization Tape', 'Heavy Duty Lead Tape', 'Pro Balance'],
                'Babolat' => ['Custom Damp Lead', 'Tungsten Tape', 'Custom Lead Tape', 'Pro Balance Weights', 'Racket Customization'],
                'Head'    => ['Tour Lead Tape 1/4"', 'Tour Lead Tape 1/2"', 'Weight Strips', 'Heavy Duty Lead Tape', 'Balance Tuning'],
                'Yonex'   => ['AC126 Lead Tape', 'AC128 Weight Strip', 'Custom Balance Tape', 'Racket Weight Adjuster', 'Tour Balance Tape'],
            ],
        ];

        foreach ($products as $category => $brands) {
            foreach ($brands as $brand => $items) {
                foreach ($items as $item) {
                    DB::table('store_items')->insert([
                        'title'       => "{$brand} {$item}",
                        'description' => "High-quality {$category} by {$brand}, model: {$item}.",
                        'brand'       => $brand,
                        'category'    => $category,
                        'sku'         => strtoupper(Str::slug($brand . '-' . $category . '-' . $item . '-' . Str::random(4))),
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }
            }
        }
    }
}
