<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Term;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Terms extends Component
{
    use WithPagination;

    public string $title = '';

    public string $content = '';

    public bool $isActive = true;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'is_active' => $this->isActive,
        ];

        if ($this->editingId) {
            $term = Term::findOrFail($this->editingId);
            $term->update($data);
            session()->flash('message', 'Term updated successfully.');
        } else {
            $maxOrder = Term::query()->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
            Term::create($data);
            session()->flash('message', 'Term created successfully.');
        }

        $this->reset(['title', 'content', 'isActive', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $this->reset(['title', 'content', 'isActive', 'editingId']);
        $this->isActive = true;
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $term = Term::findOrFail($id);

        $this->editingId = $id;
        $this->title = $term->title;
        $this->content = $term->content;
        $this->isActive = $term->is_active;

        $this->showFormModal = true;
    }

    public function cancelEdit(): void
    {
        $this->reset(['title', 'content', 'isActive', 'editingId']);
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

        Term::findOrFail($this->deletingId)->delete();
        session()->flash('message', 'Term deleted successfully.');
        $this->deletingId = null;
        $this->showDeleteModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Terms Management'])]
    #[Title('Terms Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.terms', [
            'terms' => Term::query()
                ->when($this->search, fn ($query) => $query->where('title', 'like', "%{$this->search}%"))
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}
