<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        // event(new Registered($user));

        Auth::attempt($request->only(['email', 'password']));

        $request->session()->regenerate();

        return redirect()->route('home')->with('toast', 'Register successful');
    }

}
