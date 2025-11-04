<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\LanguageController as AdminLanguageController;
use App\Http\Controllers\Admin\SeoController as AdminSeoController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Admin\OfferController as AdminOfferController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
// Offers
Route::post('/offers', [OfferController::class, 'store'])->name('offers.store');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Categories removed from admin
        Route::resource('sliders', AdminSliderController::class);
        Route::post('sliders/reorder', [AdminSliderController::class, 'reorder'])->name('sliders.reorder');
        // Posts removed from admin
        Route::resource('portfolios', AdminPortfolioController::class);
        Route::post('portfolios/reorder', [AdminPortfolioController::class, 'reorder'])->name('portfolios.reorder');
        Route::resource('offers', AdminOfferController::class)->only(['index', 'destroy']);

        Route::post('offers/bulk-delete', [AdminOfferController::class, 'bulkDelete'])->name('offers.bulkDelete');
        Route::resource('menus', AdminMenuController::class)->except(['show']);
        Route::post('menus/reorder', [AdminMenuController::class, 'reorder'])->name('menus.reorder');

        Route::get('settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');

        // SEO Management
        Route::get('seo', [AdminSeoController::class, 'edit'])->name('seo.edit');
        Route::post('seo', [AdminSeoController::class, 'update'])->name('seo.update');

        Route::get('languages', [AdminLanguageController::class, 'index'])->name('languages.index');
        Route::get('languages/{locale}/edit', [AdminLanguageController::class, 'edit'])->name('languages.edit');
        Route::put('languages/{locale}', [AdminLanguageController::class, 'update'])->name('languages.update');
    });
});
