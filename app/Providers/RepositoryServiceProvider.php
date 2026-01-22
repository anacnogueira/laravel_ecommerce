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
use App\Repositories\Contracts\PaymentMethodRepositoryInterface;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\Contracts\OrderStatusRepositoryInterface;
use App\Repositories\OrderStatusRepository;
use App\Repositories\Contracts\OrderLogRepositoryInterface;
use App\Repositories\OrderLogRepository;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\EventRepository;
use App\Repositories\Contracts\EventDateRepositoryInterface;
use App\Repositories\EventDateRepository;
use App\Repositories\Contracts\WebsiteSearchRepositoryInterface;
use App\Repositories\WebsiteSearchRepository;
use App\Repositories\Contracts\CepSearchRepositoryInterface;
use App\Repositories\CepSearchRepository;
use App\Repositories\Contracts\UserGroupRepositoryInterface;
use App\Repositories\UserGroupRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\Contracts\ModuleRepositoryInterface;
use App\Repositories\ModuleRepository;
use App\Repositories\Contracts\RoutineRepositoryInterface;
use App\Repositories\RoutineRepository;
use App\Repositories\Contracts\LogRepositoryInterface;
use App\Repositories\LogRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\Contracts\ShippingRepositoryInterface;
use App\Repositories\ShippingRepository;

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

        $this->app->bind(
            PaymentMethodRepositoryInterface::class,
            PaymentMethodRepository::class,
        );

        $this->app->bind(
            OrderStatusRepositoryInterface::class,
            OrderStatusRepository::class,
        );

        $this->app->bind(
            OrderLogRepositoryInterface::class,
            OrderLogRepository::class,
        );

        $this->app->bind(
            EventRepositoryInterface::class,
            EventRepository::class,
        );

        $this->app->bind(
            EventDateRepositoryInterface::class,
            EventDateRepository::class,
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

        $this->app->bind(
            ModuleRepositoryInterface::class,
            ModuleRepository::class,
        );

        $this->app->bind(
            RoutineRepositoryInterface::class,
            RoutineRepository::class,
        );

        $this->app->bind(
            LogRepositoryInterface::class,
            LogRepository::class,
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class,
        );

         $this->app->bind(
            ShippingRepositoryInterface::class,
            ShippingRepository::class,
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
