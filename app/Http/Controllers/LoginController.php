<?php

namespace App\Http\Controllers;

use App\Access\AuthTypes;
use App\Factories\AuthFactory;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Strategy\AuthContext;
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

    public function handlerRedirect($driver)
    {
        if(!in_array($driver, AuthTypes::getAvailableAuthMethods()))
        {
            abort(404);
        }

        return Socialite::driver($driver)->redirect();
    }

    public function handlerCallback($driver)
    {
        $authenticationInstance = AuthFactory::getAuthInstance($driver);

        $context = new AuthContext($authenticationInstance);
        $context->makeLogin();

        return redirect()->route('home')->with('toast', 'Login successful');
    }

}
