<?php

namespace App\Livewire\Pages;

use App\Models\Gallery;
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
            'galleries' => Gallery::where('is_active', true)
                ->where('category', 'quality')
                ->orderBy('order')
                ->get(),
        ]);
    }
}
