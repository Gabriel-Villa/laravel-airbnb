<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\ListingImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Listing::factory()
            ->has(ListingImages::factory()->count(3), 'images')
            ->count(50)
            ->create();
    }
}
