<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MenuService;
use App\Services\PageService;

class ViewComposerServiceProvider extends ServiceProvider
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
        view()->composer(['layouts.app'], function($view) {
            $menu = MenuService::makeMenuLinks();

            $pages = $this->app->make(PageService::class)->getActivePages();
            $view->with('menu', $menu)
                ->with('pages', $pages);


        });
    }
}
