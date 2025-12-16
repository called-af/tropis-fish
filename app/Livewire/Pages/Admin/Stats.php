<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Setting;
use App\Models\Stat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Stats extends Component
{
    use WithPagination;

    public string $label = '';

    public string $value = '';

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public string $statsTitle = '';

    public string $statsDescription = '';

    public function mount(): void
    {
        $this->statsTitle = Setting::get('stats_title', 'Trusted by Thousands of Customers') ?? 'Trusted by Thousands of Customers';
        $this->statsDescription = Setting::get('stats_description', 'Our experience and dedication in the ornamental fish industry') ?? 'Our experience and dedication in the ornamental fish industry';
    }

    public function saveSettings(): void
    {
        $this->validate([
            'statsTitle' => 'required|string|max:255',
            'statsDescription' => 'required|string|max:500',
        ]);

        Setting::set('stats_title', $this->statsTitle);
        Setting::set('stats_description', $this->statsDescription);

        session()->flash('message', 'Stats section settings saved successfully.');
    }

    public function save(): void
    {
        $validated = $this->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        if ($this->editingId) {
            $stat = Stat::findOrFail($this->editingId);
            $stat->update([
                'label' => $validated['label'],
                'value' => $validated['value'],
            ]);

            session()->flash('message', 'Stat updated successfully.');
        } else {
            // Check if we already have 4 stats
            $statsCount = Stat::count();
            if ($statsCount >= 4) {
                session()->flash('error', 'Maximum 4 stats allowed. Please delete an existing stat first.');
                $this->showFormModal = false;

                return;
            }

            $maxOrder = Stat::max('order') ?? 0;

            Stat::create([
                'label' => $validated['label'],
                'value' => $validated['value'],
                'order' => $maxOrder + 1,
                'is_active' => true,
            ]);

            session()->flash('message', 'Stat created successfully.');
        }

        $this->reset(['label', 'value', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $statsCount = Stat::count();
        if ($statsCount >= 4) {
            session()->flash('error', 'Maximum 4 stats allowed. Please delete an existing stat first.');

            return;
        }

        $this->reset(['label', 'value', 'editingId']);
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $stat = Stat::findOrFail($id);
        $this->editingId = $stat->id;
        $this->label = $stat->label;
        $this->value = $stat->value;
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

        $stat = Stat::findOrFail($this->deletingId);
        $stat->delete();
        session()->flash('message', 'Stat deleted successfully.');

        $this->reset(['deletingId']);
        $this->showDeleteModal = false;
    }

    public function cancelEdit(): void
    {
        $this->reset(['label', 'value', 'editingId']);
        $this->showFormModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Stats Management'])]
    #[Title('Stats Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.stats', [
            'stats' => Stat::query()
                ->when($this->search, fn ($query) => $query->where('label', 'like', "%{$this->search}%")
                    ->orWhere('value', 'like', "%{$this->search}%"))
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}
