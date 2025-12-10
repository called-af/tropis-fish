<?php

namespace App\Livewire\Pages\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function mount(): void
    {
        Auth::guard('admin')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.admin.logout');
    }
}
