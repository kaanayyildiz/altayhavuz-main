<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\Offer;
use Illuminate\Support\Facades\Schema;
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
            if (Schema::hasTable('settings')) {
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
            if (Schema::hasTable('menus')) {
                View::composer('layouts.app', function ($view) {
                    $headerMenus = Menu::where('status','active')
                        ->orderBy('order')
                        ->orderByDesc('id')
                        ->get();
                    $view->with('headerMenus', $headerMenus);
                });
            }

            if (Schema::hasTable('offers')) {
                View::composer('admin.layouts.app', function ($view) {
                    $unreadOffersQuery = Offer::query()->where('is_read', false);

                    $view->with([
                        'unreadOffersCount' => (clone $unreadOffersQuery)->count(),
                        'recentUnreadOffers' => (clone $unreadOffersQuery)
                            ->latest()
                            ->take(5)
                            ->get(),
                    ]);
                });
            }
        } catch (\Throwable $e) {
            // Ignore during install/migrate
        }
    }
}
