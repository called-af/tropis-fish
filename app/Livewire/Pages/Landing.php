<?php

namespace App\Livewire\Pages;

use App\Models\AboutSection;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\Setting;
use App\Models\Stat;
use App\Models\StockList;
use Livewire\Attributes\Url;
use Livewire\Component;

class Landing extends Component
{
    #[Url(as: 'q')]
    public $search = '';

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

        $statsTitle = Setting::get('stats_title', 'Trusted by Thousands of Customers');
        $statsDescription = Setting::get('stats_description', 'Our experience and dedication in the ornamental fish industry');

        // Stock list query with search
        $stockListsQuery = StockList::query();

        if ($this->search) {
            $stockListsQuery->where(function ($query) {
                $query->where('code', 'like', '%'.$this->search.'%')
                    ->orWhere('common_name', 'like', '%'.$this->search.'%')
                    ->orWhere('scientific_name', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.pages.landing', [
            'heroes' => Hero::where('is_active', true)
                ->orderBy('order')
                ->limit(3)
                ->get(),
            'galleries' => Gallery::where('is_active', true)
                ->where('category', 'fish')
                ->orderBy('order')
                ->limit(8)
                ->get(),
            'stockLists' => $stockListsQuery->orderBy('code')->get(),
            'stats' => Stat::where('is_active', true)
                ->orderBy('order')
                ->get(),
            'statsTitle' => $statsTitle,
            'statsDescription' => $statsDescription,
            'downloadLink' => $downloadUrl,
            'aboutSection' => AboutSection::where('is_active', true)
                ->orderBy('order')
                ->first(),
        ])->layout('components.layouts.app');
    }
}
