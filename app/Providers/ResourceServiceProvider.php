<?php

namespace App\Providers;

use App\Http\Resources\CategoryResource;
use Illuminate\Support\ServiceProvider;

class ResourceServiceProvider extends ServiceProvider
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
        CategoryResource::withoutWrapping();
    }
}
