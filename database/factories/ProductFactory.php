<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ShoeSize;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $jenisSepatu = ['Sepatu Lari', 'Sepatu Basket', 'Sepatu Kasual', 'Sepatu Skateboarding', 'Sepatu Sepak Bola'];
        $fiturSepatu = ['Ringan', 'Tahan Lama', 'Nyaman', 'Stylish', 'Performa Tinggi'];

        return [
            'name' => $this->faker->randomElement($jenisSepatu) . ' ' . $this->faker->colorName,
            'description' => $this->faker->randomElement($fiturSepatu) . ' ' . $this->faker->randomElement($jenisSepatu) . ' cocok untuk penggemar ' . $this->faker->word . '.',
            // Price is in rupiah
            'price' => $this->faker->numberBetween(100000, 1000000),
            'brand_id' => Brand::all()->random()->id,
            'category_id' => Category::all()->random()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $sizes = ['38', '39', '40', '41', '42', '43', '44'];
            foreach ($sizes as $size) {
                $shoeSize = ShoeSize::firstOrCreate(['size' => $size]);
                Stock::create([
                    'product_id' => $product->id,
                    'shoe_size_id' => $shoeSize->id,
                    'quantity' => $this->faker->numberBetween(1, 100),
                ]);
            }
        });
    }
}
