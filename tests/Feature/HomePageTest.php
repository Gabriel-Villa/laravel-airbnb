<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Listing;
use App\Models\Location;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class HomePageTest extends TestCase
{

    use RefreshDatabase;

    public function test_home_page_load_succesfully(): void
    {
        $this->artisan('db:seed', ['--class' => 'LocationSeeder']);
        $this->artisan('db:seed', ['--class' => 'CategorySeeder']);

        User::factory()->create();

        $response = $this->get('/');

        $response->assertSuccessful();

        $response->assertInertia(fn (Assert $page) => $page
            ->component('Home')
            ->has('listings')
        );
    }
}
