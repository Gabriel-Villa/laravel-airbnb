<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_view_home_page(): void
    {
        $response = $this->get('/')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Home')
            );

    }
}
