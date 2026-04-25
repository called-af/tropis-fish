<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function (): void {
    // Public Pages — with rate limiting to prevent abuse (60 requests/minute)
    Route::middleware(['throttle:60,1'])->group(function (): void {
        Route::get('/', App\Livewire\Pages\Landing::class)->name('home');
        Route::get('/stock-list', App\Livewire\Pages\StockList::class)->name('stock-list');
        Route::get('/gallery', App\Livewire\Pages\Gallery::class)->name('gallery');
        Route::get('/gallery/fish', App\Livewire\Pages\GalleryFish::class)->name('gallery.fish');
        Route::get('/gallery/farm', App\Livewire\Pages\GalleryFarm::class)->name('gallery.farm');
        Route::get('/gallery/quality', App\Livewire\Pages\GalleryQuality::class)->name('gallery.quality');
    });

    // Authentication Routes
    Route::middleware(['guest:admin', 'throttle:10,1'])->group(function (): void {
        Route::get('/login', App\Livewire\Pages\Auth\Login::class)->name('login');
    });

    // Admin Routes
    Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function (): void {
        Route::get('/dashboard', App\Livewire\Pages\Admin\Dashboard::class)->name('dashboard');
        Route::get('/profile', App\Livewire\Pages\Admin\Profile::class)->name('profile');
        Route::get('/logout', App\Livewire\Pages\Admin\Logout::class)->name('logout');
    });

    // Admin Management Routes
    Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function (): void {
        Route::get('/heroes', App\Livewire\Pages\Admin\Heroes::class)->name('heroes');
        Route::get('/galleries', App\Livewire\Pages\Admin\Galleries::class)->name('galleries');
        Route::get('/stock-lists', App\Livewire\Pages\Admin\StockLists::class)->name('stock-lists');
        Route::get('/stats', App\Livewire\Pages\Admin\Stats::class)->name('stats');
        Route::get('/about-sections', App\Livewire\Pages\Admin\AboutSections::class)->name('about-sections');
        Route::get('/company-sections', App\Livewire\Pages\Admin\CompanySections::class)->name('company-sections');
        Route::get('/footer-sections', App\Livewire\Pages\Admin\FooterSections::class)->name('footer-sections');
        Route::get('/terms', App\Livewire\Pages\Admin\Terms::class)->name('terms');
        Route::get('/settings', App\Livewire\Pages\Admin\WebsiteSettings::class)->name('settings');
    });
});
