<?php

namespace App\Livewire\Pages;

use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class GalleryFish extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Fish Gallery - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.gallery-fish', [
            'galleries' => Cache::remember('gallery_fish', 3600, function () {
                return Gallery::where('is_active', true)
                    ->where('category', 'fish')
                    ->orderBy('order')
                    ->get();
            }),
        ]);
    }
}
