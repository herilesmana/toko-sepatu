<?php

namespace Database\Seeders;

use App\Models\ShoeSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShoeSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            '36',
            '37',
            '38',
            '39',
            '40',
            '41',
            '42',
            '43',
            '44',
            '45',
            '46',
        ];

        foreach ($sizes as $size) {
            ShoeSize::create([
                'size' => $size,
            ]);
        }
    }
}
