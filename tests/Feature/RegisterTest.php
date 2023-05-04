<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function test_register_fail_if_email_is_not_present(): void
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $response = $this->post('/app/register', [
            'password' => 123,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $response->assertInvalid(['email']);
        $response->assertRedirect('/');
    }

    public function test_register_fail_if_password_dont_have_at_least_5_characters(): void
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $response = $this->post('/app/register', [
            'name' => $this->faker->name,
            'password' => 123,
            'email' => $this->faker->email
        ]);

        // $response->ddSession();

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
        $response->assertInvalid(['password']);
        $response->assertRedirect('/');
    }

    public function test_register_successfully_and_redirect_to_home_page()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $response = $this->post('/app/register', [
            'name' => $this->faker->name,
            'password' => 123456,
            'email' => $this->faker->email
        ]);

        $response->assertSessionHas("toast", "Register successful");

        $response->assertSessionHasNoErrors();

        $response->assertRedirect('/');
    }

}
