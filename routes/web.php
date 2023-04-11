<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::post('app/login', [LoginController::class, 'login'])->name('login.post');
Route::post('app/logout', [LoginController::class, 'logout'])->name('logout.post');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('auth/redirect', [LoginController::class, 'handlerRedirect'])->name('login.redirect');
Route::get('auth/callback', [LoginController::class, 'handlerCallback'])->name('login.callback');
