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
use App\Repositories\Contracts\StateRepositoryInterface;
use App\Repositories\StateRepository;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\CityRepository;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\EventRepository;
use App\Repositories\Contracts\PageRepositoryInterface;
use App\Repositories\PageRepository;
use App\Repositories\Contracts\PaymentGatewayRepositoryInterface;
use App\Repositories\PaymentGatewayRepository;
use App\Repositories\Contracts\PaymentMethodRepositoryInterface;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\Contracts\OrderStatusRepositoryInterface;
use App\Repositories\OrderStatusRepository;
use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Repositories\FaqRepository;
use App\Repositories\Contracts\WebsiteSearchRepositoryInterface;
use App\Repositories\WebsiteSearchRepository;
use App\Repositories\Contracts\CepSearchRepositoryInterface;
use App\Repositories\CepSearchRepository;
use App\Repositories\Contracts\UserGroupRepositoryInterface;
use App\Repositories\UserGroupRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;

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
        $this->app->bind(
            StateRepositoryInterface::class,
            StateRepository::class,
        );
        $this->app->bind(
            CityRepositoryInterface::class,
            CityRepository::class,
        );
        $this->app->bind(
            EventRepositoryInterface::class,
            EventRepository::class,
        );
        $this->app->bind(
            PageRepositoryInterface::class,
            PageRepository::class,
        );
        $this->app->bind(
            PaymentGatewayRepositoryInterface::class,
            PaymentGatewayRepository::class,
        );
        $this->app->bind(
            PaymentMethodRepositoryInterface::class,
            PaymentMethodRepository::class,
        );
        $this->app->bind(
            OrderStatusRepositoryInterface::class,
            OrderStatusRepository::class,
        );
        $this->app->bind(
            FaqRepositoryInterface::class,
            FaqRepository::class,
        );
        $this->app->bind(
            WebsiteSearchRepositoryInterface::class,
            WebsiteSearchRepository::class,
        );
        $this->app->bind(
            CepSearchRepositoryInterface::class,
            CepSearchRepository::class,
        );
        $this->app->bind(
            UserGroupRepositoryInterface::class,
            UserGroupRepository::class,
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
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
