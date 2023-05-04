<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::post('app/login', [LoginController::class, 'login'])->name('app.login');
Route::post('app/logout', [LoginController::class, 'logout'])->name('app.logout');
Route::post('app/register', RegisterController::class)->name('app.register');

Route::get('/', HomeController::class)->name('home');

Route::resource('/listing', ListingController::class)->middleware('auth')->only(['index', 'store']);
Route::resource('/listing', ListingController::class)->only(['show']);

Route::prefix('auth')->group(function()
{
    Route::get('redirect', [LoginController::class, 'handlerRedirect'])->name('login.redirect');
    Route::get('callback', [LoginController::class, 'handlerCallback'])->name('login.callback');
});

Route::resource('/reservation', ReservationController::class)->only(['store']);

Route::fallback(function () {
    return redirect()->route('home');
});
