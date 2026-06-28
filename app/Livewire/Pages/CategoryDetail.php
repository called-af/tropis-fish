<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryDetail extends Component
{
    use WithPagination;

    public string $slug;

    public Category $category;

    #[Url]
    public string $search = '';

    public string $viewMode = 'grid'; // 'grid' or 'table'

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $this->category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = $mode;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $downloadType = Setting::get('stock_list_download_type', 'link');
        $downloadUrl = null;

        if ($downloadType === 'link') {
            $downloadUrl = Setting::get('stock_list_download_link');
        } else {
            $filePath = Setting::get('stock_list_download_file');
            if ($filePath) {
                $downloadUrl = asset('storage/'.$filePath);
            }
        }

        $stockLists = $this->category->stockLists()
            ->when($this->search, fn ($query) => $query->where(fn ($q) => $q->where('common_name', 'like', "%{$this->search}%")
                ->orWhere('scientific_name', 'like', "%{$this->search}%")))
            ->orderBy('common_name')
            ->orderBy('scientific_name')
            ->paginate(12);

        return view('livewire.pages.category-detail', [
            'stockLists' => $stockLists,
            'downloadLink' => $downloadUrl,
        ])->title($this->category->name.' - PT. Tropis Fish Indonesia');
    }
}
