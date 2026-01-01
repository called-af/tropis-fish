<?php

namespace App\Livewire\Pages\Admin;

use App\Mail\ContactFormMail;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class WebsiteSettings extends Component
{
    use WithFileUploads;

    public string $websiteName = '';

    public string $companyName = '';

    public string $companyDescription = '';

    public string $contactEmail = '';

    public string $mailHost = '';

    public string $mailPort = '';

    public string $mailUsername = '';

    public string $mailPassword = '';

    public string $mailEncryption = '';

    public $logo;

    public string $seoTitle = '';

    public string $seoDescription = '';

    public string $seoKeywords = '';

    public $ogImage;

    public function mount(): void
    {
        $this->websiteName = Setting::get('website_name', 'PT. Tropis Fish Indonesia') ?? 'PT. Tropis Fish Indonesia';
        $this->companyName = Setting::get('company_name', 'PT. Tropis Fish Indonesia') ?? 'PT. Tropis Fish Indonesia';
        $this->companyDescription = Setting::get('company_description', 'Export of Ornamental Freshwater Fish') ?? 'Export of Ornamental Freshwater Fish';
        $this->contactEmail = Setting::get('contact_email', 'sales@tropisfish.com') ?? 'sales@tropisfish.com';
        $this->mailHost = Setting::get('mail_host', 'smtp.gmail.com') ?? 'smtp.gmail.com';
        $this->mailPort = Setting::get('mail_port', '587') ?? '587';
        $this->mailUsername = Setting::get('mail_username', '') ?? '';
        $this->mailPassword = Setting::get('mail_password', '') ?? '';
        $this->mailEncryption = Setting::get('mail_encryption', 'tls') ?? 'tls';
        $this->seoTitle = Setting::get('seo_title', '') ?? '';
        $this->seoDescription = Setting::get('seo_description', '') ?? '';
        $this->seoKeywords = Setting::get('seo_keywords', '') ?? '';
    }

    public function getCurrentLogoProperty()
    {
        return Setting::get('company_logo');
    }

    public function getCurrentOgImageProperty()
    {
        return Setting::get('og_image');
    }

    public function testEmail(): void
    {
        try {
            config([
                'mail.mailers.smtp.host' => $this->mailHost,
                'mail.mailers.smtp.port' => $this->mailPort,
                'mail.mailers.smtp.username' => $this->mailUsername,
                'mail.mailers.smtp.password' => $this->mailPassword ?: Setting::get('mail_password', ''),
                'mail.mailers.smtp.encryption' => $this->mailEncryption,
            ]);

            Mail::to($this->contactEmail)->send(new ContactFormMail(
                senderName: 'Test Email System',
                senderEmail: $this->contactEmail,
                senderPhone: 'N/A',
                emailSubject: 'SMTP Configuration Test',
                messageContent: 'This is a test email to verify your SMTP settings are working correctly. If you received this email, your configuration is successful!'
            ));

            session()->flash('test_email_success', "Test email sent successfully! Please check your inbox at {$this->contactEmail}");
        } catch (\Exception $e) {
            session()->flash('test_email_error', "Failed to send test email: {$e->getMessage()}");
            \Log::error('SMTP test failed', [
                'error' => $e->getMessage(),
                'host' => $this->mailHost,
                'port' => $this->mailPort,
                'username' => $this->mailUsername,
            ]);
        }
    }

    public function save(): void
    {
        $this->validate([
            'websiteName' => 'required|string|max:255',
            'companyName' => 'required|string|max:255',
            'companyDescription' => 'required|string|max:255',
            'contactEmail' => 'required|email|max:255',
            'mailHost' => 'required|string|max:255',
            'mailPort' => 'required|numeric',
            'mailUsername' => 'nullable|string|max:255',
            'mailPassword' => 'nullable|string|max:255',
            'mailEncryption' => 'required|string|in:tls,ssl',
            'logo' => 'nullable|image|max:7168',
            'seoTitle' => 'nullable|string|max:255',
            'seoDescription' => 'nullable|string|max:500',
            'seoKeywords' => 'nullable|string|max:500',
            'ogImage' => 'nullable|image|max:7168',
        ]);

        Setting::set('website_name', $this->websiteName);
        Setting::set('company_name', $this->companyName);
        Setting::set('company_description', $this->companyDescription);
        Setting::set('contact_email', $this->contactEmail);
        Setting::set('mail_host', $this->mailHost);
        Setting::set('mail_port', $this->mailPort);
        Setting::set('mail_username', $this->mailUsername);

        if ($this->mailPassword) {
            Setting::set('mail_password', $this->mailPassword);
        }

        Setting::set('mail_encryption', $this->mailEncryption);
        Setting::set('seo_title', $this->seoTitle);
        Setting::set('seo_description', $this->seoDescription);
        Setting::set('seo_keywords', $this->seoKeywords);

        if ($this->logo) {
            $oldLogo = Setting::get('company_logo');
            if ($oldLogo && \Storage::disk('public')->exists($oldLogo)) {
                \Storage::disk('public')->delete($oldLogo);
            }

            $logoPath = $this->logo->store('settings', 'public');
            Setting::set('company_logo', $logoPath);
            $this->reset('logo');
        }

        if ($this->ogImage) {
            $oldOgImage = Setting::get('og_image');
            if ($oldOgImage && \Storage::disk('public')->exists($oldOgImage)) {
                \Storage::disk('public')->delete($oldOgImage);
            }

            $ogImagePath = $this->ogImage->store('settings', 'public');
            Setting::set('og_image', $ogImagePath);
            $this->reset('ogImage');
        }

        session()->flash('message', 'Website settings saved successfully.');
    }

    #[Layout('components.layouts.admin', ['heading' => 'Website Settings'])]
    #[Title('Website Settings - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.website-settings');
    }
}
