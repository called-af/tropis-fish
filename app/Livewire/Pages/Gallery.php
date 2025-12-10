<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Gallery extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Gallery - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.gallery');
    }
}
