<?php

namespace Tests\Feature;

use App\Contracts\ListingImage;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListingPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_listing_page_redirect_if_user_is_not_authenticable(): void
    {
        $response = $this->get('/listing');

        $response->assertRedirect('/');
    }

    public function test_listing_page_load_succesfully_if_user_is_authenticable(): void
    {

        $response = $this->actingAs($this->user)->get('/listing');

        $response->assertSuccessful();

        $response->assertInertia(fn (Assert $page) => $page
            ->component('Listing/Index')
        );
    }

    public function test_create_listing_fail_if_fields_are_not_present_except_location()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->artisan('db:seed', ['--class' => 'LocationSeeder']);
        $this->artisan('db:seed', ['--class' => 'CategorySeeder']);

        $response = $this->actingAs($this->user)->post('/listing', [
            'location' => Location::inRandomOrder()->first()->code
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['category', 'guestCount','roomCount', 'bathroomCount', 'title', 'description', 'price']);
    }

    public function test_create_listing_succesfully()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->artisan('db:seed', ['--class' => 'LocationSeeder']);
        $this->artisan('db:seed', ['--class' => 'CategorySeeder']);

        $file = UploadedFile::fake()->image('image.png');

        $response = $this->actingAs($this->user)->post('/listing', [
            'location' => Location::inRandomOrder()->first()->code,
            'category' => Category::inRandomOrder()->first()->id,
            'guestCount' => 4,
            'roomCount' => 2,
            'bathroomCount' => 2,
            'title' => 'My space in airbnb',
            'description' => 'My space in airbnb description',
            'image' => [$file],
            'price' => 154.50,
        ]);

        $this->assertDatabaseCount('listing', 1);
        $this->assertDatabaseCount('listing_images', 1);
        $this->assertDatabaseHas('listing', [
            'guestCount' => 4,
            'roomCount' => 2,
            'bathroomCount' => 2,
            'title' => "My Space In Airbnb",
            'description' => "My space in airbnb description",
            'price' => (154.50 * 100)
        ]);

        $response->assertRedirect(route('home'));
    }

}
