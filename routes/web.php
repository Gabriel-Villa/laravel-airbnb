<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;

Route::prefix('app')->as('app.')->group(function()
{
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('register', RegisterController::class)->name('register');
});

Route::get('/', HomeController::class)->name('home');

Route::resource('/listing', ListingController::class)->only(['index', 'store', 'show']);

Route::prefix('auth')->group(function()
{
    Route::get('redirect', [LoginController::class, 'handlerRedirect'])->name('login.redirect');
    Route::get('callback', [LoginController::class, 'handlerCallback'])->name('login.callback');
});

Route::resource('/reservation', ReservationController::class)->only(['store']);

Route::fallback(function () {
    return redirect()->route('home');
});
