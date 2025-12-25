<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class WebsiteSettings extends Component
{
    use WithFileUploads;

    public string $websiteName = '';

    public string $companyName = '';

    public $logo;

    public string $seoTitle = '';

    public string $seoDescription = '';

    public string $seoKeywords = '';

    public $ogImage;

    public function mount(): void
    {
        $this->websiteName = Setting::get('website_name', 'PT. Tropis Fish Indonesia') ?? 'PT. Tropis Fish Indonesia';
        $this->companyName = Setting::get('company_name', 'PT. Tropis Fish Indonesia') ?? 'PT. Tropis Fish Indonesia';
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

    public function save(): void
    {
        $this->validate([
            'websiteName' => 'required|string|max:255',
            'companyName' => 'required|string|max:255',
            'logo' => 'nullable|image|max:7168',
            'seoTitle' => 'nullable|string|max:255',
            'seoDescription' => 'nullable|string|max:500',
            'seoKeywords' => 'nullable|string|max:500',
            'ogImage' => 'nullable|image|max:7168',
        ]);

        Setting::set('website_name', $this->websiteName);
        Setting::set('company_name', $this->companyName);
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
