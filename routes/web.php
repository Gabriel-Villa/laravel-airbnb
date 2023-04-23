<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('app/login', [LoginController::class, 'login'])->name('app.login');
Route::post('app/logout', [LoginController::class, 'logout'])->name('app.logout');

Route::get('/', HomeController::class)->name('home');


Route::group(['middleware' => 'auth'], function()
{
    Route::resource('/listing', ListingController::class);
});


Route::get('auth/redirect', [LoginController::class, 'handlerRedirect'])->name('login.redirect');
Route::get('auth/callback', [LoginController::class, 'handlerCallback'])->name('login.callback');
