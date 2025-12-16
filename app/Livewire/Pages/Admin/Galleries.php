<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Gallery;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Galleries extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $title = '';

    public string $description = '';

    public string $category = 'fish';

    public $image;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public string $categoryFilter = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:fish,farm,quality',
            'image' => $this->editingId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('galleries', 'public');
        }

        if ($this->editingId) {
            $gallery = Gallery::findOrFail($this->editingId);
            $gallery->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'image_path' => $imagePath ?? $gallery->image_path,
            ]);

            session()->flash('message', 'Gallery updated successfully.');
        } else {
            $maxOrder = Gallery::where('category', $validated['category'])->max('order') ?? 0;

            Gallery::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'order' => $maxOrder + 1,
                'is_active' => true,
                'image_path' => $imagePath,
            ]);

            session()->flash('message', 'Gallery created successfully.');
        }

        $this->reset(['title', 'description', 'category', 'image', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $this->reset(['title', 'description', 'category', 'image', 'editingId']);
        $this->category = 'fish';
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $gallery = Gallery::findOrFail($id);
        $this->editingId = $gallery->id;
        $this->title = $gallery->title;
        $this->description = $gallery->description ?? '';
        $this->category = $gallery->category;
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

        $gallery = Gallery::findOrFail($this->deletingId);

        if ($gallery->image_path && \Storage::disk('public')->exists($gallery->image_path)) {
            \Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();
        session()->flash('message', 'Gallery deleted successfully.');

        $this->reset(['deletingId']);
        $this->showDeleteModal = false;
    }

    public function cancelEdit(): void
    {
        $this->reset(['title', 'description', 'category', 'image', 'editingId']);
        $this->showFormModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Gallery Management'])]
    #[Title('Gallery Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.galleries', [
            'galleries' => Gallery::query()
                ->when($this->search, fn ($query) => $query->where('title', 'like', "%{$this->search}%"))
                ->when($this->categoryFilter, fn ($query) => $query->where('category', $this->categoryFilter))
                ->orderBy('category')
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}
