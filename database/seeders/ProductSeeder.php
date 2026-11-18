<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. The Main Product (This is your DEFAULT FEATURE IMAGE)
        $steak = Product::updateOrCreate(
            ['name' => 'Corporate lunch'],
            [
                'category' => 'Package 1',
                'description' => 'Amazing taste and healthy food with variations.',
                // Best Practice: This should be your most attractive "Hero" image.
                'gallery' => 'images/8.png', 
                'product_type' => 'variable'
            ]
        );

        // 2. The 7 Variants (These are the specific daily images)
        $variants = [
            ['name' => 'SAT', 'price' => 185, 'image' => 'images/1.png'],
            ['name' => 'SUN', 'price' => 225, 'image' => 'images/2.png'],
            ['name' => 'MON', 'price' => 225, 'image' => 'images/3.png'],
            ['name' => 'TUE', 'price' => 225, 'image' => 'images/4.png'],
            ['name' => 'WED', 'price' => 225, 'image' => 'images/5.png'],
            ['name' => 'THU', 'price' => 225, 'image' => 'images/6.png'],
            ['name' => 'FRI', 'price' => 225, 'image' => 'images/7.png'],
        ];

        foreach ($variants as $v) {
            ProductVariant::updateOrCreate(
                [
                    'product_id' => $steak->id, 
                    'variant_name' => $v['name'] 
                ],
                [
                    'price' => $v['price'],
                    // Ensure this column 'variant_image' exists in your DB via migration!
                    'variant_image' => $v['image'] 
                ]
            );
        }
    } 
}