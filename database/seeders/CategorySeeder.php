<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Houses', 'icon' => 'fa-solid fa-house']);
        Category::create(['name' => 'Populars', 'icon' => 'fa-solid fa-fire']);
        Category::create(['name' => 'Islands', 'icon' => 'fa-solid fa-umbrella-beach']);
        Category::create(['name' => 'Ships', 'icon' => 'fa-solid fa-ship']);
        Category::create(['name' => 'Artic', 'icon' => 'fa-solid fa-snowboarding']);
    }
}
