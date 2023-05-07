<?php

namespace App\Access;
use Laravel\Socialite\Facades\Socialite;
use App\Contracts\AuthStrategy;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthGithub implements AuthStrategy
{
    public function login()
    {
        $user = Socialite::driver(AuthTypes::AUTH_GITHUB)->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $user->email],
            ['password' => Str::random(10), 'name' => $user->name]
        );

        Auth::login($user, true);
    }
}
