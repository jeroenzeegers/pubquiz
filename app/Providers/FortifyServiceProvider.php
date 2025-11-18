<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(fn (Request $request) => Inertia::render('auth/login', [
            'canResetPassword' => Features::enabled(Features::resetPasswords()),
            'status' => $request->session()->get('status'),
            'seo' => [
                'title' => 'Inloggen - Weetje Ietta?',
                'description' => 'Log in op je account voor de Scheveningse Pubquiz.',
                'url' => config('app.url') . '/login',
            ],
        ]));

        Fortify::resetPasswordView(fn (Request $request) => Inertia::render('auth/reset-password', [
            'email' => $request->email,
            'token' => $request->route('token'),
            'seo' => [
                'title' => 'Wachtwoord resetten - Weetje Ietta?',
                'description' => 'Reset je wachtwoord voor de Scheveningse Pubquiz.',
                'url' => config('app.url') . '/reset-password',
            ],
        ]));

        Fortify::requestPasswordResetLinkView(fn (Request $request) => Inertia::render('auth/forgot-password', [
            'status' => $request->session()->get('status'),
            'seo' => [
                'title' => 'Wachtwoord vergeten - Weetje Ietta?',
                'description' => 'Vraag een wachtwoord reset link aan voor je account.',
                'url' => config('app.url') . '/forgot-password',
            ],
        ]));

        Fortify::verifyEmailView(fn (Request $request) => Inertia::render('auth/verify-email', [
            'status' => $request->session()->get('status'),
            'seo' => [
                'title' => 'E-mail verificatie - Weetje Ietta?',
                'description' => 'Verifieer je e-mailadres om verder te gaan.',
                'url' => config('app.url') . '/verify-email',
            ],
        ]));

        Fortify::twoFactorChallengeView(fn () => Inertia::render('auth/two-factor-challenge', [
            'seo' => [
                'title' => 'Twee-factor authenticatie - Weetje Ietta?',
                'description' => 'Voer je twee-factor authenticatie code in.',
                'url' => config('app.url') . '/two-factor-challenge',
            ],
        ]));

        Fortify::confirmPasswordView(fn () => Inertia::render('auth/confirm-password', [
            'seo' => [
                'title' => 'Bevestig wachtwoord - Weetje Ietta?',
                'description' => 'Bevestig je wachtwoord om verder te gaan.',
                'url' => config('app.url') . '/confirm-password',
            ],
        ]));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }
}
