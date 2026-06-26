<?php

use App\Livewire\Pages\Admin\AboutSections;
use App\Livewire\Pages\Admin\Categories;
use App\Livewire\Pages\Admin\CompanySections;
use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Admin\FooterSections;
use App\Livewire\Pages\Admin\Galleries;
use App\Livewire\Pages\Admin\Heroes;
use App\Livewire\Pages\Admin\Logout;
use App\Livewire\Pages\Admin\Profile;
use App\Livewire\Pages\Admin\Stats;
use App\Livewire\Pages\Admin\StockLists;
use App\Livewire\Pages\Admin\Terms;
use App\Livewire\Pages\Admin\WebsiteSettings;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\CategoryDetail;
use App\Livewire\Pages\Gallery;
use App\Livewire\Pages\GalleryFarm;
use App\Livewire\Pages\GalleryFish;
use App\Livewire\Pages\GalleryQuality;
use App\Livewire\Pages\Landing;
use App\Livewire\Pages\StockList;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function (): void {
    // Public Pages — with rate limiting to prevent abuse (60 requests/minute)
    Route::middleware(['throttle:60,1'])->group(function (): void {
        Route::get('/', Landing::class)->name('home');
        Route::get('/stock-list', StockList::class)->name('stock-list');
        Route::get('/category/{slug}', CategoryDetail::class)->name('category.detail');
        Route::get('/gallery', Gallery::class)->name('gallery');
        Route::get('/gallery/fish', GalleryFish::class)->name('gallery.fish');
        Route::get('/gallery/farm', GalleryFarm::class)->name('gallery.farm');
        Route::get('/gallery/quality', GalleryQuality::class)->name('gallery.quality');
    });

    // Authentication Routes
    Route::middleware(['guest:admin', 'throttle:10,1'])->group(function (): void {
        Route::get('/login', Login::class)->name('login');
    });

    // Admin Routes
    Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function (): void {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/profile', Profile::class)->name('profile');
        Route::get('/logout', Logout::class)->name('logout');
    });

    // Admin Management Routes
    Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function (): void {
        Route::get('/heroes', Heroes::class)->name('heroes');
        Route::get('/galleries', Galleries::class)->name('galleries');
        Route::get('/stock-lists', StockLists::class)->name('stock-lists');
        Route::get('/categories', Categories::class)->name('categories');
        Route::get('/stats', Stats::class)->name('stats');
        Route::get('/about-sections', AboutSections::class)->name('about-sections');
        Route::get('/company-sections', CompanySections::class)->name('company-sections');
        Route::get('/footer-sections', FooterSections::class)->name('footer-sections');
        Route::get('/terms', Terms::class)->name('terms');
        Route::get('/settings', WebsiteSettings::class)->name('settings');
    });
});
