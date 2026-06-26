<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\Setting;
use App\Models\StockList as StockListModel;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class StockList extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url(as: 'c')]
    public string $category = '';

    public string $viewMode = 'grid'; // 'grid' or 'table'

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = $mode;
    }

    #[Layout('components.layouts.app')]
    #[Title('Stock List - PT. Tropis Fish Indonesia')]
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

        $stockLists = StockListModel::query()
            ->with('category')
            ->when($this->search, fn ($query) => $query->where('code', 'like', "%{$this->search}%")
                ->orWhere('common_name', 'like', "%{$this->search}%")
                ->orWhere('scientific_name', 'like', "%{$this->search}%"))
            ->when($this->category, fn ($query) => $query->whereHas('category', fn ($q) => $q->where('slug', $this->category)))
            ->orderBy('code')
            ->paginate(12);

        return view('livewire.pages.stock-list', [
            'stockLists' => $stockLists,
            'categories' => Cache::remember('active_categories', 3600, function () {
                return Category::where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get();
            }),
            'downloadLink' => $downloadUrl,
        ]);
    }
}
