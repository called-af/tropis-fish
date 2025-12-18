<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::truncate();

        $sourceBase = public_path('assets');
        $destinationBase = storage_path('app/public/gallery');

        $categories = [
            'fish' => 'Fish Gallery',
            'farm' => 'Farm Gallery',
            'qc' => 'Quality Control',
        ];

        foreach ($categories as $folder => $defaultTitle) {

            $sourcePath = $sourceBase.'/'.$folder;
            if (! File::exists($sourcePath)) {
                continue;
            }

            $destinationPath = $destinationBase.'/'.$folder;
            if (! File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $order = 1;

            foreach (File::files($sourcePath) as $file) {

                $filename = $file->getFilename();

                // copy file (simulate upload)
                File::copy(
                    $file->getRealPath(),
                    $destinationPath.'/'.$filename
                );

                Gallery::create([
                    'title' => ucwords(str_replace(['-', '_'], ' ', pathinfo($filename, PATHINFO_FILENAME))),
                    'description' => $defaultTitle,
                    'image_path' => "gallery/{$folder}/{$filename}",
                    'category' => $folder === 'qc' ? 'quality' : $folder,
                    'order' => $order++,
                    'is_active' => true,
                ]);
            }
        }
    }
}
