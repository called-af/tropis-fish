<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $subject = '';

    public string $message = '';

    public function submit(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        session()->flash('contact_success', 'Thank you for contacting us! We will get back to you soon.');

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
