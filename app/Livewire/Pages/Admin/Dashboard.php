<?php

namespace App\Livewire\Pages\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    public function logout()
    {
        Auth::guard('admin')->logout();

        session()->invalidate();
        session()->regenerateToken();

        return $this->redirect(route('admin.login'), navigate: true);
    }

    #[Layout('components.layouts.admin')]
    #[Title('Dashboard - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.dashboard');
    }
}
