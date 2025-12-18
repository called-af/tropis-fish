<?php

namespace App\Livewire\Pages;

use App\Models\Setting;
use App\Models\StockList as StockListModel;
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

    public string $viewMode = 'grid'; // 'grid' or 'table'

    public function updatingSearch(): void
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

        return view('livewire.pages.stock-list', [
            'stockLists' => StockListModel::query()
                ->when($this->search, fn ($query) => $query->where('code', 'like', "%{$this->search}%")
                    ->orWhere('common_name', 'like', "%{$this->search}%")
                    ->orWhere('scientific_name', 'like', "%{$this->search}%"))
                ->orderBy('code')
                ->paginate(12),
            'downloadLink' => $downloadUrl,
        ]);
    }
}
