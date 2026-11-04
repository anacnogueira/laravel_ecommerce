<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use App\Hashing\CakeSHA1Hasher;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Validation\Rules\Password;

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
        Blade::withoutDoubleEncoding();
        Paginator::useBootstrap();

        Hash::extend('cake_sha1', function ($app) {
            return new CakeSHA1Hasher();
        });

        ResetPassword::createUrlUsing(function (object $user, string $token) {
            if ($user instanceof User) {
                return url("/admin/password/reset/{$token}");
            }

            if ($user instanceof Contact) {
                return url("/resetar-senha/{$token}");
            }

        });

        $this->definePasswordRules();
    }

    private function definePasswordRules()
    {
        Password::defaults(function () {
            if ($this->app->isProduction()) {
                return Password::min(8)
                    ->max(15)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised();
            }

            return Password::min(6);
        });
    }
}
