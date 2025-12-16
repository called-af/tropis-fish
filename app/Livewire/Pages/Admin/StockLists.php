<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Setting;
use App\Models\StockList;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class StockLists extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $code = '';

    public string $commonName = '';

    public string $scientificName = '';

    public string $size = '';

    public string $length = '';

    public $image;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public string $downloadType = 'link';

    public ?string $downloadLink = '';

    public $downloadFile;

    public function mount(): void
    {
        $this->downloadType = Setting::get('stock_list_download_type', 'link') ?? 'link';
        $this->downloadLink = Setting::get('stock_list_download_link', '') ?? '';
    }

    public function getCurrentFileProperty()
    {
        return Setting::get('stock_list_download_file');
    }

    public function saveDownloadLink(): void
    {
        if ($this->downloadType === 'link') {
            $this->validate([
                'downloadLink' => 'required|url',
            ]);

            Setting::set('stock_list_download_type', 'link');
            Setting::set('stock_list_download_link', $this->downloadLink);
            Setting::set('stock_list_download_file', null);
        } else {
            $this->validate([
                'downloadFile' => 'required|mimes:pdf,xlsx,xls,csv|max:10240',
            ]);

            // Delete old file if exists
            $oldFile = Setting::get('stock_list_download_file');
            if ($oldFile && \Storage::disk('public')->exists($oldFile)) {
                \Storage::disk('public')->delete($oldFile);
            }

            $filePath = $this->downloadFile->store('downloads', 'public');

            Setting::set('stock_list_download_type', 'file');
            Setting::set('stock_list_download_file', $filePath);
            Setting::set('stock_list_download_link', null);
        }

        session()->flash('message', 'Download settings saved successfully.');
        $this->reset(['downloadFile']);
    }

    public function save(): void
    {
        $validated = $this->validate([
            'code' => 'required|string|max:255|unique:stock_lists,code,'.$this->editingId,
            'scientificName' => 'required|string|max:255',
            'commonName' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'length' => 'required|string|max:255',
            'image' => $this->editingId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('stock-lists', 'public');
        }

        if ($this->editingId) {
            $stockList = StockList::findOrFail($this->editingId);
            $stockList->update([
                'code' => $validated['code'],
                'scientific_name' => $validated['scientificName'],
                'common_name' => $validated['commonName'],
                'size' => $validated['size'],
                'length' => $validated['length'],
                'image_path' => $imagePath ?? $stockList->image_path,
            ]);

            session()->flash('message', 'Stock list updated successfully.');
        } else {
            StockList::create([
                'code' => $validated['code'],
                'scientific_name' => $validated['scientificName'],
                'common_name' => $validated['commonName'],
                'size' => $validated['size'],
                'length' => $validated['length'],
                'image_path' => $imagePath,
            ]);

            session()->flash('message', 'Stock list created successfully.');
        }

        $this->reset(['code', 'commonName', 'scientificName', 'size', 'length', 'image', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $this->reset(['code', 'commonName', 'scientificName', 'size', 'length', 'image', 'editingId']);
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $stockList = StockList::findOrFail($id);
        $this->editingId = $stockList->id;
        $this->code = $stockList->code;
        $this->scientificName = $stockList->scientific_name;
        $this->commonName = $stockList->common_name;
        $this->size = $stockList->size;
        $this->length = $stockList->length;
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

        $stockList = StockList::findOrFail($this->deletingId);

        if ($stockList->image_path && \Storage::disk('public')->exists($stockList->image_path)) {
            \Storage::disk('public')->delete($stockList->image_path);
        }

        $stockList->delete();
        session()->flash('message', 'Stock list deleted successfully.');

        $this->reset(['deletingId']);
        $this->showDeleteModal = false;
    }

    public function cancelEdit(): void
    {
        $this->reset(['code', 'commonName', 'scientificName', 'size', 'length', 'image', 'editingId']);
        $this->showFormModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Stock List Management'])]
    #[Title('Stock List Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.stock-lists', [
            'stockLists' => StockList::query()
                ->when($this->search, fn ($query) => $query->where('code', 'like', "%{$this->search}%")
                    ->orWhere('common_name', 'like', "%{$this->search}%")
                    ->orWhere('scientific_name', 'like', "%{$this->search}%"))
                ->orderBy('code')
                ->paginate(10),
        ]);
    }
}
