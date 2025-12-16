<?php

namespace App\Livewire\Pages;

use App\Models\Gallery;
use App\Models\Hero;
use App\Models\Setting;
use App\Models\Stat;
use App\Models\StockList;
use Livewire\Component;

class Landing extends Component
{
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

        return view('livewire.pages.landing', [
            'heroes' => Hero::where('is_active', true)
                ->orderBy('order')
                ->limit(3)
                ->get(),
            'galleries' => Gallery::where('is_active', true)
                ->orderBy('order')
                ->limit(8)
                ->get(),
            'stockLists' => StockList::orderBy('code')
                ->limit(3)
                ->get(),
            'stats' => Stat::where('is_active', true)
                ->orderBy('order')
                ->get(),
            'statsTitle' => $statsTitle,
            'statsDescription' => $statsDescription,
            'downloadLink' => $downloadUrl,
        ])->layout('components.layouts.app');
    }
}
