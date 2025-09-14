<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        // Define unique 3 attributes per category
        $categoryAttributes = [
            'Rackets'    => [
                ['name' => 'Head Size', 'input_type' => 'number'],
                ['name' => 'Weight', 'input_type' => 'number'],
                ['name' => 'Length', 'input_type' => 'number'],
            ],
            'Balls'      => [
                ['name' => 'Amount in Pack', 'input_type' => 'number'],
                ['name' => 'Material', 'input_type' => 'text'],
                ['name' => 'Color', 'input_type' => 'text'],
            ],
            'Dampeners'  => [
                ['name' => 'Material', 'input_type' => 'text'],
                ['name' => 'Color', 'input_type' => 'text'],
                ['name' => 'Weight', 'input_type' => 'number'],
            ],
            'Overgrips'  => [
                ['name' => 'Material', 'input_type' => 'text'],
                ['name' => 'Length', 'input_type' => 'number'],
                ['name' => 'Color', 'input_type' => 'text'],
            ],
            'Base Grips' => [
                ['name' => 'Length', 'input_type' => 'number'],
                ['name' => 'Material', 'input_type' => 'text'],
                ['name' => 'Color', 'input_type' => 'text'],
            ],
            'Lead Tapes' => [
                ['name' => 'Weight', 'input_type' => 'number'],
                ['name' => 'Length', 'input_type' => 'number'],
                ['name' => 'Material', 'input_type' => 'text'],
            ],
        ];

        // Store inserted attribute IDs
        $attributeIds = [];

        foreach ($categoryAttributes as $categoryName => $attrs) {
            foreach ($attrs as $attr) {
                // Avoid duplicate attributes globally by checking name
                $existingId = DB::table('attributes')->where('name', $attr['name'])->value('id');
                if ($existingId) {
                    $attrId = $existingId;
                } else {
                    $attrId = DB::table('attributes')->insertGetId([
                        'name' => $attr['name'],
                        'input_type' => $attr['input_type'],
                    ]);
                }

                $attributeIds[$categoryName][] = $attrId;
            }
        }

        // Insert into pivot table: category_attribute
        foreach ($attributeIds as $categoryName => $attrIds) {
            $categoryId = DB::table('categories')->where('name', $categoryName)->value('id');

            foreach ($attrIds as $attrId) {
                DB::table('category_attribute')->insert([
                    'category_id' => $categoryId,
                    'attribute_id' => $attrId,
                    'required' => true,
                ]);
            }
        }
    }
}
