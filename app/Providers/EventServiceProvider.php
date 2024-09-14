<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
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
                'text' => 'Sales',
                'url' => '#',
                'icon' => 'nav-icon fa fa-shopping-cart fa-fw'
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
                ]
            ]);
            $event->menu->add([
                'text' => 'Customers',
                'url' => '#',
                'icon' => 'nav-icon fa fa-users fa-fw'
            ]);
            $event->menu->add([
                'text' => 'Newsletters',
                'url' => '#',
                'icon' => 'nav-icon fa fa-envelope fa-fw'
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
                    [
                        'text' => 'Payment Methods',
                        'url' => '/admin/payment-methods',
                        'icon' => 'fa fa-credit-card'
                    ],
                    [
                        'text' => 'Order Status',
                        'url' => '/admin/order-status',
                        'icon' => 'fa fa-check-square'
                    ],
                    [
                        'text' => 'FAQ',
                        'url' => '/admin/faqs',
                        'icon' => 'fa fa-question'
                    ],
                    [
                        'text' => 'Events',
                        'url' => '/admin/events',
                        'icon' => 'fa fa-book'
                    ],
                    [
                        'text' => 'Countries',
                        'url' => '/admin/countries',
                        'icon' => 'fa fa-globe'
                    ],
                    [
                        'text' => 'States',
                        'url' => '/admin/states',
                        'icon' => 'fa fa-globe'
                    ],
                    [
                        'text' => 'Cities',
                        'url' => '/admin/cities',
                        'icon' => 'fa fa-globe'
                    ],
                ]
            ]);
            $event->menu->add([
                'text' => 'Reports',
                'url' => '#',
                'icon' => 'nav-icon fas fa-chart-bar fa-fw',
                'submenu' => [
                    [
                        'text' => 'Website search',
                        'url' => '/admin/website-searches',
                        'icon' => 'fas fa-chart-area'
                    ],
                ],    
            ]);
            $event->menu->add([
                'text' => 'System',
                'url' => '#',
                'icon' => 'nav-icon fa fa-cog fa-fw'
            ]);

        });
    }
}
