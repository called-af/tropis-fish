<?php

namespace App\Livewire\Pages\Admin;

use App\Models\FooterSection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class FooterSections extends Component
{
    public string $type = 'company';

    public string $description = '';

    public array $links = [];

    public string $copyrightText = '';

    public bool $isActive = true;

    public ?int $editingId = null;

    public bool $showFormModal = false;

    public function mount(): void
    {
        $this->links = [];
        $this->loadCompanySection();
    }

    protected function loadCompanySection(): void
    {
        $section = FooterSection::where('type', 'company')->first();
        if ($section) {
            $this->editingId = $section->id;
            $this->description = $section->description ?? '';
            $this->copyrightText = $section->copyright_text ?? '';
            $this->isActive = $section->is_active;
        }
    }

    public function openModal(string $type): void
    {
        if ($type === 'company') {
            $this->loadCompanySection();
            $this->type = 'company';
            if (! $this->editingId) {
                $this->description = 'Premium quality tropical ornamental fish supplier for your aquarium';
                $this->copyrightText = 'All rights reserved';
            }
        } else {
            $section = FooterSection::where('type', $type)->first();
            $this->type = $type;
            $this->editingId = $section?->id;
            $this->links = $section?->links ?? [];

            if (! $section) {
                $this->setDefaultsByType($type);
            }
        }

        $this->showFormModal = true;
    }

    protected function setDefaultsByType(string $type): void
    {
        match ($type) {
            'menu' => $this->setMenuDefaults(),
            'information' => $this->setInformationDefaults(),
            'social' => $this->setSocialDefaults(),
            default => null,
        };
    }

    protected function setMenuDefaults(): void
    {
        $this->links = [
            ['text' => 'Home', 'url' => '/'],
            ['text' => 'Company Profile', 'url' => '/#company-profile'],
            ['text' => 'Stock List', 'url' => '/#stock-list'],
            ['text' => 'Gallery', 'url' => '/#gallery'],
        ];
    }

    protected function setInformationDefaults(): void
    {
        $this->links = [
            ['text' => 'How to Order', 'url' => '#'],
            ['text' => 'Privacy Policy', 'url' => '#'],
            ['text' => 'Terms & Conditions', 'url' => '#terms'],
        ];
    }

    protected function setSocialDefaults(): void
    {
        $this->links = [
            ['text' => 'Facebook', 'url' => '#', 'icon' => 'facebook'],
            ['text' => 'Twitter', 'url' => '#', 'icon' => 'twitter'],
            ['text' => 'Instagram', 'url' => '#', 'icon' => 'instagram'],
        ];
    }

    public function addLink(): void
    {
        $this->links[] = [
            'text' => '',
            'url' => '',
            'icon' => $this->type === 'social' ? 'facebook' : null,
        ];
    }

    public function removeLink(int $index): void
    {
        unset($this->links[$index]);
        $this->links = array_values($this->links);
    }

    public function save(): void
    {
        if ($this->type === 'company') {
            $validated = $this->validate([
                'description' => 'required|string',
                'copyrightText' => 'required|string|max:255',
            ]);

            $data = [
                'type' => 'company',
                'title' => 'Company Info',
                'description' => $validated['description'],
                'links' => [],
                'copyright_text' => $validated['copyrightText'],
                'order' => 0,
                'is_active' => $this->isActive,
            ];

            if ($this->editingId) {
                FooterSection::findOrFail($this->editingId)->update($data);
                session()->flash('message', 'Company info updated successfully.');
            } else {
                FooterSection::create($data);
                session()->flash('message', 'Company info created successfully.');
            }
        } else {
            $validated = $this->validate([
                'type' => 'required|in:menu,information,social',
                'links' => 'required|array|min:1',
                'links.*.text' => 'required|string|max:255',
                'links.*.url' => 'required|string|max:255',
                'links.*.icon' => 'nullable|string|max:255',
            ]);

            $titleMap = [
                'menu' => 'Menu',
                'information' => 'Information',
                'social' => 'Follow Us',
            ];

            $orderMap = [
                'menu' => 1,
                'information' => 2,
                'social' => 3,
            ];

            $data = [
                'type' => $validated['type'],
                'title' => $titleMap[$validated['type']],
                'description' => null,
                'links' => $this->links,
                'copyright_text' => null,
                'order' => $orderMap[$validated['type']],
                'is_active' => $this->isActive,
            ];

            if ($this->editingId) {
                FooterSection::findOrFail($this->editingId)->update($data);
                session()->flash('message', ucfirst($this->type).' section updated successfully.');
            } else {
                FooterSection::create($data);
                session()->flash('message', ucfirst($this->type).' section created successfully.');
            }
        }

        $this->reset(['type', 'description', 'links', 'copyrightText', 'isActive', 'editingId']);
        $this->showFormModal = false;
        $this->loadCompanySection();
    }

    public function cancelEdit(): void
    {
        $this->reset(['type', 'description', 'links', 'copyrightText', 'isActive', 'editingId']);
        $this->showFormModal = false;
        $this->loadCompanySection();
    }

    #[Layout('components.layouts.admin', ['heading' => 'Footer Management'])]
    #[Title('Footer Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        $companySection = FooterSection::where('type', 'company')->first();
        $menuSection = FooterSection::where('type', 'menu')->first();
        $informationSection = FooterSection::where('type', 'information')->first();
        $socialSection = FooterSection::where('type', 'social')->first();

        return view('livewire.pages.admin.footer-sections', [
            'companySection' => $companySection,
            'menuSection' => $menuSection,
            'informationSection' => $informationSection,
            'socialSection' => $socialSection,
        ]);
    }
}
