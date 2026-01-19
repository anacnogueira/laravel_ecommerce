<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Services\ModuleMenuService;

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
            $modules = ModuleMenuService::makeMenuLinks();
            $items = [];

            foreach ($modules as $module) {
                $subitems = [];

                $items[$module->id] = [
                    'text' => $module->name,
                    'url' => url($module->slug),
                    'icon' => $module->icon,
                ];

                if (count($module->children) > 0) {
                    foreach ($module->children as $children) {
                        $subitems[] = [
                            'text' => $children->name,
                            'url' =>  $children->slug,
                            'icon' => $children->icon
                        ];
                    }
                }

                if (count($subitems) > 0) {
                    $items[$module->id]['submenu'] = $subitems;
                }
            }

            $event->menu->add(...$items);

        });
    }
}
