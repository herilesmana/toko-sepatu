<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            ShoeSizesSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,

            // DataJuni2024Seeder::class,
            // DataJuli2024Seeder::class,
            // DataAgustus2024Seeder::class,
        ]);
    }
}
