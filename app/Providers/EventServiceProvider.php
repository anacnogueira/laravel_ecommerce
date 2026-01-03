<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            $event->menu->add([
                'header'=> 'main_navigation',
                'classes' => 'text-bold text-center',
            ]);
            $event->menu->add([
                'text' => 'Dashboard',
                'url' => 'admin/',
                'icon' => 'nav-icon fas fa-tachometer-alt'
            ]);

            $event->menu->add([
                'text' => 'Catalog',
                'url' => '#',
                'icon' => 'nav-icon fa fa-tags fa-fw',
                'submenu' => [
                    [
                        'text' => 'Categories',
                        'url' => '/admin/categories',
                        'icon' => 'fa fa-cubes'
                    ],
                    [
                        'text' => 'Brands',
                        'url' => '/admin/brands',
                        'icon' => 'fa fa-gem'
                    ],
                    [
                        'text' => 'Suppliers',
                        'url' => '/admin/suppliers',
                        'icon' => 'fa fa-user-secret'
                    ],
                    [
                        'text' => 'Partners',
                        'url' => '/admin/partners',
                        'icon' => 'fa fa-user'
                    ],
                    [
                        'text' => 'Products',
                        'url' => '/admin/products',
                        'icon' => 'fa fa-cube'
                    ],
                    [
                        'text' => 'Comments',
                        'url' => '/admin/comments',
                        'icon' => 'fa fa-comment'
                    ]
                ]
            ]);

            $event->menu->add([
                'text' => 'Content',
                'url' => '#',
                'icon' => 'nav-icon fa fa-cubes fa-fw',
                'submenu' => [
                    [
                        'text' => 'Pages',
                        'url' => '/admin/pages',
                        'icon' => 'far fa-file-alt'
                    ],
                    [
                        'text' => 'Banners',
                        'url' => '/admin/banners',
                        'icon' => 'fa fa-star'
                    ],
                     [
                        'text' => 'Payment Gateways',
                        'url' => '/admin/payment-gateways',
                        'icon' => 'fa fa-sitemap'
                    ],
                ],
            ]);
        });
    }
}
