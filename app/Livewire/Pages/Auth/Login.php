<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $validated = $this->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
        ]);

        if (! Auth::guard('admin')->attempt($validated, $this->remember)) {
            $this->addError('email', 'The provided credentials do not match our records.');

            return;
        }

        session()->regenerate();

        $this->redirect(route('admin.dashboard'), navigate: true);
    }

    #[Layout('components.layouts.app')]
    #[Title('Login - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
