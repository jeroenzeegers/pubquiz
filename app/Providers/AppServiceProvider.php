<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Pulse\Facades\Pulse;

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
        Pulse::user(fn ($user) => [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => null,
        ]);

        Gate::define('viewPulse', function ($user) {
            return $user->email === 'jeroenzeegers@me.com';
        });
    }
}
