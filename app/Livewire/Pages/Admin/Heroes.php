<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Hero;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Heroes extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $title = '';

    public string $description = '';

    public $image;

    public $video;

    public string $youtubeUrl = '';

    public string $backgroundType = 'image';

    public bool $isActive = true;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function save(): void
    {
        $heroCount = Hero::count();

        if (! $this->editingId && $heroCount >= 3) {
            session()->flash('error', 'Maximum 3 heroes allowed. Please delete one first.');

            return;
        }

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'backgroundType' => 'required|in:image,video,youtube',
            'isActive' => 'boolean',
        ];

        if ($this->backgroundType === 'image') {
            $rules['image'] = $this->editingId ? 'nullable|image|max:7168' : 'required|image|max:7168';
        } elseif ($this->backgroundType === 'video') {
            $rules['video'] = 'required|mimes:mp4,mov,avi,wmv|max:51200';
            $rules['image'] = 'nullable|image|max:7168';
        } elseif ($this->backgroundType === 'youtube') {
            $rules['youtubeUrl'] = 'required|url';
            $rules['image'] = 'nullable|image|max:7168';
        }

        $validated = $this->validate($rules);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('heroes', 'public');
        }

        $videoPath = null;
        if ($this->video && $this->backgroundType === 'video') {
            $videoPath = $this->video->store('heroes/videos', 'public');
        }

        $youtubeUrl = null;
        if ($this->backgroundType === 'youtube') {
            $youtubeUrl = $this->youtubeUrl;
        }

        if ($this->editingId) {
            $hero = Hero::findOrFail($this->editingId);
            $hero->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'background_type' => $validated['backgroundType'],
                'image_path' => $imagePath ?? $hero->image_path,
                'video_path' => $videoPath,
                'youtube_url' => $youtubeUrl,
                'is_active' => $validated['isActive'],
            ]);

            session()->flash('message', 'Hero updated successfully.');
        } else {
            $maxOrder = Hero::max('order') ?? 0;

            Hero::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'background_type' => $validated['backgroundType'],
                'image_path' => $imagePath,
                'video_path' => $videoPath,
                'youtube_url' => $youtubeUrl,
                'is_active' => $validated['isActive'],
                'order' => $maxOrder + 1,
            ]);

            session()->flash('message', 'Hero created successfully.');
        }

        $this->reset(['title', 'description', 'image', 'video', 'youtubeUrl', 'backgroundType', 'isActive', 'editingId']);
        $this->isActive = true;
        $this->backgroundType = 'image';
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $heroCount = Hero::count();

        if ($heroCount >= 3) {
            session()->flash('error', 'Maximum 3 heroes allowed. Please delete one first.');

            return;
        }

        $this->reset(['title', 'description', 'image', 'video', 'youtubeUrl', 'backgroundType', 'isActive', 'editingId']);
        $this->isActive = true;
        $this->backgroundType = 'image';
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $hero = Hero::findOrFail($id);
        $this->editingId = $hero->id;
        $this->title = $hero->title;
        $this->description = $hero->description ?? '';
        $this->backgroundType = $hero->background_type ?? 'image';
        $this->youtubeUrl = $hero->youtube_url ?? '';
        $this->isActive = $hero->is_active;
        $this->showFormModal = true;
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

        $hero = Hero::findOrFail($this->deletingId);

        if ($hero->image_path && \Storage::disk('public')->exists($hero->image_path)) {
            \Storage::disk('public')->delete($hero->image_path);
        }

        if ($hero->video_path && \Storage::disk('public')->exists($hero->video_path)) {
            \Storage::disk('public')->delete($hero->video_path);
        }

        $hero->delete();
        session()->flash('message', 'Hero deleted successfully.');

        $this->reset(['deletingId']);
        $this->showDeleteModal = false;
    }

    public function cancelEdit(): void
    {
        $this->reset(['title', 'description', 'image', 'video', 'youtubeUrl', 'backgroundType', 'isActive', 'editingId']);
        $this->showFormModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Hero Management'])]
    #[Title('Hero Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.heroes', [
            'heroes' => Hero::query()
                ->when($this->search, fn ($query) => $query->where('title', 'like', "%{$this->search}%"))
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}
