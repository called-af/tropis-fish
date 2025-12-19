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

    public function mount(): void
    {
        $this->websiteName = Setting::get('website_name', 'PT. Tropis Fish Indonesia') ?? 'PT. Tropis Fish Indonesia';
        $this->companyName = Setting::get('company_name', 'PT. Tropis Fish Indonesia') ?? 'PT. Tropis Fish Indonesia';
    }

    public function getCurrentLogoProperty()
    {
        return Setting::get('company_logo');
    }

    public function save(): void
    {
        $this->validate([
            'websiteName' => 'required|string|max:255',
            'companyName' => 'required|string|max:255',
            'logo' => 'nullable|image|max:7168',
        ]);

        Setting::set('website_name', $this->websiteName);
        Setting::set('company_name', $this->companyName);

        if ($this->logo) {
            // Delete old logo if exists
            $oldLogo = Setting::get('company_logo');
            if ($oldLogo && \Storage::disk('public')->exists($oldLogo)) {
                \Storage::disk('public')->delete($oldLogo);
            }

            $logoPath = $this->logo->store('settings', 'public');
            Setting::set('company_logo', $logoPath);
            $this->reset('logo');
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
