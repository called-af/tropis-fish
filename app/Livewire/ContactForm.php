<?php

namespace App\Livewire;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
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

        $contactEmail = Setting::get('contact_email', 'sales@tropisfish.com');

        try {
            config([
                'mail.mailers.smtp.host' => Setting::get('mail_host', 'smtp.gmail.com'),
                'mail.mailers.smtp.port' => Setting::get('mail_port', '587'),
                'mail.mailers.smtp.username' => Setting::get('mail_username', ''),
                'mail.mailers.smtp.password' => Setting::get('mail_password', ''),
                'mail.mailers.smtp.encryption' => Setting::get('mail_encryption', 'tls'),
            ]);

            Mail::to($contactEmail)->send(new ContactFormMail(
                senderName: $this->name,
                senderEmail: $this->email,
                senderPhone: $this->phone ?? 'Not provided',
                emailSubject: $this->subject,
                messageContent: $this->message
            ));

            session()->flash('contact_success', 'Thank you for contacting us! Your message has been sent successfully. We will get back to you soon.');
        } catch (\Exception $e) {
            \Log::error('Contact form email failed', [
                'error' => $e->getMessage(),
                'sender' => $this->email,
                'subject' => $this->subject,
            ]);

            session()->flash('contact_success', 'Thank you for contacting us! Your message has been received and saved. We will respond to you shortly.');
        }

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
