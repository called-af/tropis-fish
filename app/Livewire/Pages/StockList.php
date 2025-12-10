<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class StockList extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Stock List - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.stock-list');
    }
}
