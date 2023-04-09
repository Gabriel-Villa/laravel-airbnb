<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors('Ocurrio un error');
    }

}
