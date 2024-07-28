<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Lari', 'description' => 'Sepatu lari'],
            ['name' => 'Basket', 'description' => 'Sepatu basket'],
            ['name' => 'Kasual', 'description' => 'Sepatu kasual'],
            ['name' => 'Skateboarding', 'description' => 'Sepatu skateboarding'],
            ['name' => 'Sepak Bola', 'description' => 'Sepatu sepak bola'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
