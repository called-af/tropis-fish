<?php

namespace App\Livewire\Pages\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Profile extends Component
{
    public string $name = '';

    public string $email = '';

    public string $currentPassword = '';

    public string $newPassword = '';

    public string $newPasswordConfirmation = '';

    public bool $showPasswordFields = false;

    public function mount(): void
    {
        $admin = Auth::guard('admin')->user();
        $this->name = $admin->name;
        $this->email = $admin->email;
    }

    public function updateProfile(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,'.Auth::guard('admin')->id(),
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        session()->flash('message', 'Profile updated successfully.');
    }

    public function updatePassword(): void
    {
        $validated = $this->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (! Hash::check($validated['currentPassword'], $admin->password)) {
            $this->addError('currentPassword', 'Current password is incorrect.');

            return;
        }

        $admin->update([
            'password' => Hash::make($validated['newPassword']),
        ]);

        $this->reset(['currentPassword', 'newPassword', 'newPasswordConfirmation', 'showPasswordFields']);
        session()->flash('message', 'Password updated successfully.');
    }

    public function togglePasswordFields(): void
    {
        $this->showPasswordFields = ! $this->showPasswordFields;

        if (! $this->showPasswordFields) {
            $this->reset(['currentPassword', 'newPassword', 'newPasswordConfirmation']);
            $this->resetErrorBag();
        }
    }

    #[Layout('components.layouts.admin', ['heading' => 'Profile Settings'])]
    #[Title('Profile Settings - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.profile');
    }
}
