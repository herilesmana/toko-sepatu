<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['name' => 'Nike', 'description' => 'Sportswear and shoes'],
            ['name' => 'Adidas', 'description' => 'Sportswear and shoes'],
            ['name' => 'Puma', 'description' => 'Sportswear and shoes'],
            ['name' => 'Reebok', 'description' => 'Sportswear and shoes'],
            ['name' => 'Vans', 'description' => 'Skate shoes and apparel'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
