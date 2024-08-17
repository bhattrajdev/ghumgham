<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register any additional services here
    }

    public const HOME = '/home';

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        parent::boot();

        // Load web routes
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Load admin routes
        Route::middleware('web')
            ->group(base_path('routes/admin.php'));
    }
}
