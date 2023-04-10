<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class MacroProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('success', function ($data) {
            return response()->json([
                'data' => $data,
                'status' => 202,
                'statusText' => 'Success',
            ], 202);
        });

        Response::macro('error', function ($data) {
            return response()->json([
                'data' => $data,
                'status' => 404,
                'statusText' => 'Error',
            ], 404);
        });
    }
}
