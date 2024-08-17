<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Repositories\BannerRepository;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\BrandRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\CountryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BannerRepositoryInterface::class,
            BannerRepository::class,
        );
        $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class,
        );
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );
        $this->app->bind(
            CountryRepositoryInterface::class,
            CountryRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
