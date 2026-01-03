<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\Contracts\ProductPhotoRepositoryInterface;
use App\Repositories\ProductPhotoRepository;
use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Repositories\BannerRepository;
use App\Repositories\Contracts\PageRepositoryInterface;
use App\Repositories\PageRepository;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\BrandRepository;
use App\Repositories\Contracts\SupplierRepositoryInterface;
use App\Repositories\SupplierRepository;
use App\Repositories\Contracts\PartnerRepositoryInterface;
use App\Repositories\PartnerRepository;
use App\Repositories\Contracts\ContactAddressRepositoryInterface;
use App\Repositories\ContactAddressRepository;
use App\Repositories\CountryRepository;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Contracts\StateRepositoryInterface;
use App\Repositories\StateRepository;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\CityRepository;
use App\Repositories\Contracts\ContactInfoRepositoryInterface;
use App\Repositories\ContactInfoRepository;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\Contracts\ProductNotificationRepositoryInterface;
use App\Repositories\ProductNotificationRepository;
use App\Repositories\Contracts\ReportSearchRepositoryInterface;
use App\Repositories\ReportSearchRepository;
use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Repositories\FaqRepository;
use App\Repositories\Contracts\ContactNewsletterRepositoryInterface;
use App\Repositories\ContactNewsletterRepository;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\CustomerRepository;
use App\Repositories\Contracts\PaymentGatewayRepositoryInterface;
use App\Repositories\PaymentGatewayRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class,
        );

         $this->app->bind(
            ProductPhotoRepositoryInterface::class,
            ProductPhotoRepository::class,
        );

        $this->app->bind(
            BannerRepositoryInterface::class,
            BannerRepository::class,
        );

         $this->app->bind(
            PageRepositoryInterface::class,
            PageRepository::class,
        );

        $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class,
        );

        $this->app->bind(
            SupplierRepositoryInterface::class,
            SupplierRepository::class,
        );

        $this->app->bind(
            PartnerRepositoryInterface::class,
            PartnerRepository::class,
        );

        $this->app->bind(
            ContactAddressRepositoryInterface::class,
            ContactAddressRepository::class,
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
            ContactInfoRepositoryInterface::class,
            ContactInfoRepository::class,
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class,
        );

        $this->app->bind(
            ProductNotificationRepositoryInterface::class,
            ProductNotificationRepository::class,
        );

        $this->app->bind(
            ReportSearchRepositoryInterface::class,
            ReportSearchRepository::class,
        );

        $this->app->bind(
            FaqRepositoryInterface::class,
            FaqRepository::class,
        );

        $this->app->bind(
            ContactNewsletterRepositoryInterface::class,
            ContactNewsletterRepository::class,
        );

        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class,
        );

         $this->app->bind(
            PaymentGatewayRepositoryInterface::class,
            PaymentGatewayRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
