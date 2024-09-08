<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddBuyPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products with no buy price
        $products = \App\Models\Product::whereNull('buy_price')->get();

        // Loop through each product
        foreach ($products as $product) {
            // Get the price
            $price = $product->price;

            // Calculate the buy price
            $buyPrice = $price * 0.8;

            // Update the product
            $product->update([
                'buy_price' => $buyPrice,
            ]);
        }
    }
}
