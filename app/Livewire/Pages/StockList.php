<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\Setting;
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

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Layout('components.layouts.app')]
    #[Title('Categories - PT. Tropis Fish Indonesia')]
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

        $categoriesQuery = Category::where('is_active', true)
            ->withCount('stockLists')
            ->orderBy('sort_order')
            ->orderBy('name');

        if ($this->search) {
            $categoriesQuery->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        $categories = $categoriesQuery->paginate(12);

        return view('livewire.pages.stock-list', [
            'categories' => $categories,
            'downloadLink' => $downloadUrl,
        ]);
    }
}
