<?php

namespace App\Livewire\Pages;

use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class GalleryFarm extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Farm Gallery - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.gallery-farm', [
            'galleries' => Cache::remember('gallery_farm', 3600, function () {
                return Gallery::where('is_active', true)
                    ->where('category', 'farm')
                    ->orderBy('order')
                    ->get();
            }),
        ]);
    }
}
