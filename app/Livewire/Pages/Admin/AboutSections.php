<?php

namespace App\Livewire\Pages\Admin;

use App\Models\AboutSection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AboutSections extends Component
{
    use WithFileUploads, WithPagination;

    public string $title = '';

    public string $description1 = '';

    public string $description2 = '';

    public $image;

    public ?string $currentImagePath = null;

    public string $feature1Title = '';

    public string $feature1Description = '';

    public string $feature1Icon = 'check-circle';

    public string $feature2Title = '';

    public string $feature2Description = '';

    public string $feature2Icon = 'currency-dollar';

    public string $feature3Title = '';

    public string $feature3Description = '';

    public string $feature3Icon = 'truck';

    public string $feature4Title = '';

    public string $feature4Description = '';

    public string $feature4Icon = 'heart';

    public bool $isActive = true;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function getAvailableIcons(): array
    {
        return [
            'check-circle' => 'Check Circle',
            'currency-dollar' => 'Currency Dollar',
            'truck' => 'Truck',
            'heart' => 'Heart',
            'star' => 'Star',
            'shield-check' => 'Shield Check',
            'sparkles' => 'Sparkles',
            'bolt' => 'Bolt',
            'fire' => 'Fire',
            'globe-alt' => 'Globe',
            'light-bulb' => 'Light Bulb',
            'rocket-launch' => 'Rocket',
            'trophy' => 'Trophy',
            'academic-cap' => 'Academic Cap',
            'beaker' => 'Beaker',
            'chart-bar' => 'Chart Bar',
            'clock' => 'Clock',
            'cog-6-tooth' => 'Settings',
            'gift' => 'Gift',
            'hand-thumb-up' => 'Thumbs Up',
            'wrench-screwdriver' => 'Tools',
            'users' => 'Users',
            'user-group' => 'User Group',
            'pencil' => 'Pencil',
            'photo' => 'Photo',
            'video-camera' => 'Video',
            'musical-note' => 'Music',
            'phone' => 'Phone',
            'envelope' => 'Envelope',
            'map-pin' => 'Map Pin',
            'building-office' => 'Office Building',
            'home' => 'Home',
            'briefcase' => 'Briefcase',
            'banknotes' => 'Banknotes',
            'credit-card' => 'Credit Card',
            'calculator' => 'Calculator',
            'presentation-chart-line' => 'Presentation',
            'document-text' => 'Document',
            'clipboard-document-check' => 'Clipboard Check',
        ];
    }

    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'image' => $this->editingId ? 'nullable|image|max:7168' : 'required|image|max:7168',
            'feature1Title' => 'nullable|string|max:255',
            'feature1Description' => 'nullable|string',
            'feature1Icon' => 'nullable|string|max:255',
            'feature2Title' => 'nullable|string|max:255',
            'feature2Description' => 'nullable|string',
            'feature2Icon' => 'nullable|string|max:255',
            'feature3Title' => 'nullable|string|max:255',
            'feature3Description' => 'nullable|string',
            'feature3Icon' => 'nullable|string|max:255',
            'feature4Title' => 'nullable|string|max:255',
            'feature4Description' => 'nullable|string',
            'feature4Icon' => 'nullable|string|max:255',
        ]);

        $data = [
            'title' => $validated['title'],
            'description_1' => $validated['description1'],
            'description_2' => $validated['description2'],
            'feature_1_title' => $validated['feature1Title'],
            'feature_1_description' => $validated['feature1Description'],
            'feature_1_icon' => $validated['feature1Icon'],
            'feature_2_title' => $validated['feature2Title'],
            'feature_2_description' => $validated['feature2Description'],
            'feature_2_icon' => $validated['feature2Icon'],
            'feature_3_title' => $validated['feature3Title'],
            'feature_3_description' => $validated['feature3Description'],
            'feature_3_icon' => $validated['feature3Icon'],
            'feature_4_title' => $validated['feature4Title'],
            'feature_4_description' => $validated['feature4Description'],
            'feature_4_icon' => $validated['feature4Icon'],
            'is_active' => $this->isActive,
        ];

        if ($this->image) {
            $data['image_path'] = $this->image->store('about', 'public');
        }

        // If setting this section to active, deactivate all others
        if ($this->isActive) {
            AboutSection::query()->update(['is_active' => false]);
        }

        if ($this->editingId) {
            $aboutSection = AboutSection::findOrFail($this->editingId);

            // Delete old image if new image uploaded
            if (isset($data['image_path']) && $aboutSection->image_path && \Storage::disk('public')->exists($aboutSection->image_path)) {
                \Storage::disk('public')->delete($aboutSection->image_path);
            }

            $aboutSection->update($data);
            session()->flash('message', 'About section updated successfully.');
        } else {
            $maxOrder = AboutSection::query()->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
            AboutSection::create($data);
            session()->flash('message', 'About section created successfully.');
        }

        $this->reset(['title', 'description1', 'description2', 'image', 'currentImagePath', 'feature1Title', 'feature1Description', 'feature1Icon', 'feature2Title', 'feature2Description', 'feature2Icon', 'feature3Title', 'feature3Description', 'feature3Icon', 'feature4Title', 'feature4Description', 'feature4Icon', 'isActive', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $this->reset(['title', 'description1', 'description2', 'image', 'currentImagePath', 'feature1Title', 'feature1Description', 'feature1Icon', 'feature2Title', 'feature2Description', 'feature2Icon', 'feature3Title', 'feature3Description', 'feature3Icon', 'feature4Title', 'feature4Description', 'feature4Icon', 'isActive', 'editingId']);
        $this->feature1Icon = 'check-circle';
        $this->feature2Icon = 'currency-dollar';
        $this->feature3Icon = 'truck';
        $this->feature4Icon = 'heart';
        $this->isActive = true;
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $aboutSection = AboutSection::findOrFail($id);

        $this->editingId = $id;
        $this->title = $aboutSection->title;
        $this->description1 = $aboutSection->description_1;
        $this->description2 = $aboutSection->description_2 ?? '';
        $this->currentImagePath = $aboutSection->image_path;
        $this->feature1Title = $aboutSection->feature_1_title ?? '';
        $this->feature1Description = $aboutSection->feature_1_description ?? '';
        $this->feature1Icon = $aboutSection->feature_1_icon ?? 'check-circle';
        $this->feature2Title = $aboutSection->feature_2_title ?? '';
        $this->feature2Description = $aboutSection->feature_2_description ?? '';
        $this->feature2Icon = $aboutSection->feature_2_icon ?? 'currency-dollar';
        $this->feature3Title = $aboutSection->feature_3_title ?? '';
        $this->feature3Description = $aboutSection->feature_3_description ?? '';
        $this->feature3Icon = $aboutSection->feature_3_icon ?? 'truck';
        $this->feature4Title = $aboutSection->feature_4_title ?? '';
        $this->feature4Description = $aboutSection->feature_4_description ?? '';
        $this->feature4Icon = $aboutSection->feature_4_icon ?? 'heart';
        $this->isActive = $aboutSection->is_active;

        $this->showFormModal = true;
    }

    public function cancelEdit(): void
    {
        $this->reset(['title', 'description1', 'description2', 'image', 'currentImagePath', 'feature1Title', 'feature1Description', 'feature1Icon', 'feature2Title', 'feature2Description', 'feature2Icon', 'feature3Title', 'feature3Description', 'feature3Icon', 'feature4Title', 'feature4Description', 'feature4Icon', 'isActive', 'editingId']);
        $this->showFormModal = false;
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if (! $this->deletingId) {
            return;
        }

        AboutSection::findOrFail($this->deletingId)->delete();
        session()->flash('message', 'About section deleted successfully.');
        $this->deletingId = null;
        $this->showDeleteModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'About Sections Management'])]
    #[Title('About Sections Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.about-sections', [
            'aboutSections' => AboutSection::query()
                ->when($this->search, fn ($query) => $query->where('title', 'like', "%{$this->search}%"))
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}
