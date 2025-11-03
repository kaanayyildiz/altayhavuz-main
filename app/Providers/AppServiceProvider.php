<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Menu;
use Illuminate\Support\Facades\View;

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
        try {
            // Apply settings if table exists
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $appName = Setting::get('app_name');
                $locale = Setting::get('locale');
                if ($appName) {
                    config(['app.name' => $appName]);
                }
                if ($locale) {
                    app()->setLocale($locale);
                }
            }

            // (removed) header categories composer

            // Share header menus to layout
            if (\Illuminate\Support\Facades\Schema::hasTable('menus')) {
                View::composer('layouts.app', function ($view) {
                    $headerMenus = Menu::where('status','active')
                        ->orderBy('order')
                        ->orderByDesc('id')
                        ->get();
                    $view->with('headerMenus', $headerMenus);
                });
            }
        } catch (\Throwable $e) {
            // Ignore during install/migrate
        }
    }
}
