<?php

namespace App\Livewire\Pages;

use App\Models\Gallery as GalleryModel;
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
            'fishGalleries' => GalleryModel::where('is_active', true)
                ->where('category', 'fish')
                ->orderBy('order')
                ->get(),
            'farmGalleries' => GalleryModel::where('is_active', true)
                ->where('category', 'farm')
                ->orderBy('order')
                ->get(),
            'qualityGalleries' => GalleryModel::where('is_active', true)
                ->where('category', 'quality')
                ->orderBy('order')
                ->get(),
        ]);
    }
}
