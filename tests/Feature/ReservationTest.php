<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\Reservation;
use App\Models\User;
use App\Providers\NewListingReservation;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_reservation_fails_if_user_is_not_logged()
    {
        $response = $this->post('/reservation', []);

        $response->assertRedirect();
    }

    public function test_store_reservation_fails_if_fields_are_not_present()
    {
        $this->artisan('db:seed', ['--class' => 'LocationSeeder']);
        $this->artisan('db:seed', ['--class' => 'CategorySeeder']);

        Listing::factory()->create();

        $response = $this->actingAs($this->user)->post('/reservation', []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['startDate', 'endDate', 'listingId']);
    }

    public function test_store_reservation_fails_if_end_date_are_less_equal_than_start_date()
    {
        $this->artisan('db:seed', ['--class' => 'LocationSeeder']);
        $this->artisan('db:seed', ['--class' => 'CategorySeeder']);

        $listing = Listing::factory()->create();

        $response = $this->actingAs($this->user)->post('/reservation', [
            'startDate' => now()->format("d/m/Y"),
            'endDate' => now()->format("d/m/Y"),
            'listingId' => $listing->id
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors(['endDate']);
    }

    public function test_store_reservation_successfully()
    {
        // $this->withoutExceptionHandling();

        Event::fake([NewListingReservation::class]);

        $this->artisan('db:seed', ['--class' => 'LocationSeeder']);
        $this->artisan('db:seed', ['--class' => 'CategorySeeder']);

        $listing = Listing::factory()->create();

        $response = $this->actingAs($this->user)->post('/reservation', [
            'startDate' => now()->format("d/m/Y"),
            'endDate' => now()->addDays(5)->format("d/m/Y"),
            'listingId' => $listing->id
        ]);

        Event::assertDispatched(NewListingReservation::class);

        $response->assertRedirect();

        $response->assertRedirect(route('home'));
    }

}
