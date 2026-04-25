<?php

namespace App\Livewire\Pages;

use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class GalleryQuality extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Quality Control Gallery - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.gallery-quality', [
            'galleries' => Cache::remember('gallery_quality', 3600, function () {
                return Gallery::where('is_active', true)
                    ->where('category', 'quality')
                    ->orderBy('order')
                    ->get();
            }),
        ]);
    }
}
