<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(100),
            'description' => $this->faker->text(200),
            'roomCount' => $this->faker->numberBetween(1, 8),
            'bathroomCount' => $this->faker->numberBetween(1, 8),
            'guestCount' => $this->faker->numberBetween(1, 20),
            'price' => $this->faker->numberBetween(1000, 18000),
            'locationId' => Location::inRandomOrder()->first()->id,
            'categoryId' => Category::inRandomOrder()->first()->id,
            'userId' => User::inRandomOrder()->first()->id,
        ];
    }
}
