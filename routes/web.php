<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function (): void {
    // Public Pages
    Route::get('/', App\Livewire\Pages\Landing::class)->name('home');
    Route::get('/company-profile', App\Livewire\Pages\CompanyProfile::class)->name('company-profile');
    Route::get('/stock-list', App\Livewire\Pages\StockList::class)->name('stock-list');
    Route::get('/product/{code?}', App\Livewire\Pages\ProductDetail::class)->name('product-detail');
    Route::get('/gallery', App\Livewire\Pages\Gallery::class)->name('gallery');
    Route::get('/terms', App\Livewire\Pages\Terms::class)->name('terms');
    Route::get('/contact', App\Livewire\Pages\Contact::class)->name('contact');

    // Authentication Routes
    Route::middleware(['guest:admin', 'throttle:10,1'])->group(function (): void {
        Route::get('/login', App\Livewire\Pages\Auth\Login::class)->name('login');
    });

    // Admin Routes
    Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function (): void {
        Route::get('/dashboard', App\Livewire\Pages\Admin\Dashboard::class)->name('dashboard');
        Route::get('/logout', App\Livewire\Pages\Admin\Logout::class)->name('logout');
    });
});
