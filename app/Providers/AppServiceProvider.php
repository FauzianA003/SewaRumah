<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Ini kode Gate Anda (berdiri sendiri)
        Gate::define('access-admin', function ($user) {
            return $user->email === 'admin@gmail.com';
        });

        // 2. Ini kode paksa HTTPS (ditaruh di luar Gate, di bawahnya)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
