<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Terms extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Terms & Condition - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.terms');
    }
}
