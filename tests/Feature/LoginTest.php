<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    public function test_login_fail_if_email_is_not_present(): void
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $response = $this->post('/app/login', [
            'password' => 123,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $response->assertInvalid(['email']);
        $response->assertRedirect('/');
    }

    public function test_login_fail_if_email_doesnt_exist_in_the_database()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $response = $this->post('/app/login', [
            'password' => 123,
            'email' => 'dev@gmail.com'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'The email dont exists'
        ]);
        $response->assertInvalid(['email']);
        $response->assertRedirect('/');
    }

    public function test_loging_fail_if_password_dont_match()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->state(['password' => 123])->create();

        $response = $this->post('/app/login', [
            'password' => 1234,
            'email' => $user->email
        ]);

        $response->assertSessionHasErrors();

        $response->assertRedirect('/');
    }

    public function test_loging_successfully_and_redirect_to_home_page()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->state(['password' => 123])->create();

        $response = $this->post('/app/login', [
            'password' => 123,
            'email' => $user->email
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect('/');
    }

}
