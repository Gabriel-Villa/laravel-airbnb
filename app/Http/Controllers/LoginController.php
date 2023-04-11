<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


class LoginController extends Controller
{

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect()->back();
        }

        return back()->withErrors('Ocurrio un error');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    public function handlerRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handlerCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => 'dev@gmail.com'],
            ['password' => Str::random(10), 'name' => $user->name]
        );

        Auth::login($user, true);

        return redirect()->route('home')->with('toast', 'Login successful');

    }

}
