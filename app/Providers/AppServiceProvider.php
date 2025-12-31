<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use App\Hashing\CakeSHA1Hasher;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\User;

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

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return env('APP_URL') . '/admin/password/reset/' . $token;
        });
    }
}
