<?php

namespace App\Livewire\Pages;

use App\Models\Gallery as GalleryModel;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Gallery extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Gallery - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.gallery', [
            'fishGalleries' => Cache::remember('gallery_fish', 3600, function () {
                return GalleryModel::where('is_active', true)
                    ->where('category', 'fish')
                    ->orderBy('order')
                    ->get();
            }),
            'farmGalleries' => Cache::remember('gallery_farm', 3600, function () {
                return GalleryModel::where('is_active', true)
                    ->where('category', 'farm')
                    ->orderBy('order')
                    ->get();
            }),
            'qualityGalleries' => Cache::remember('gallery_quality', 3600, function () {
                return GalleryModel::where('is_active', true)
                    ->where('category', 'quality')
                    ->orderBy('order')
                    ->get();
            }),
        ]);
    }
}
