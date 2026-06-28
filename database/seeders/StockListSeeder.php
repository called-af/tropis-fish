<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\StockList;
use Illuminate\Database\Seeder;

class StockListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stocks = [
            [
                'common_name' => 'BLACK GHOST',
                'scientific_name' => 'Apteronotus albifrons',
                'length' => '40-50 cm',
                'image_path' => 'assets/fish/BLACK GHOST.jpeg',
                'category_slug' => 'brackish-fish-others',
            ],
            [
                'common_name' => 'CLOWN LOACH',
                'scientific_name' => 'Chromobotia macracanthus',
                'length' => '15-20 cm',
                'image_path' => 'assets/fish/CLOWN LOACH.jpeg',
                'category_slug' => 'loach',
            ],
            [
                'common_name' => 'GREEN NEON TETRA',
                'scientific_name' => 'Paracheirodon simulans',
                'length' => '2-3 cm',
                'image_path' => 'assets/fish/GREEN NEON TETRA.png',
                'category_slug' => 'characin',
            ],
            [
                'common_name' => 'ORANGE MINI MEXICAN CRAYFISH',
                'scientific_name' => 'Cambarellus patzcuarensis',
                'length' => '3-4 cm',
                'image_path' => 'assets/fish/ORANGE MINI MEXICAN CRAYFISH.png',
                'category_slug' => 'crayfish',
            ],
            [
                'common_name' => 'ORANGE RABBIT SNAIL',
                'scientific_name' => 'Tylomelania sp.',
                'length' => '5-8 cm',
                'image_path' => 'assets/fish/ORANGE RABBIT SNAIL.png',
                'category_slug' => 'snail',
            ],
            [
                'common_name' => 'PANDA CORYDORAS',
                'scientific_name' => 'Corydoras panda',
                'length' => '4-5 cm',
                'image_path' => 'assets/fish/PANDA CORYDORAS.png',
                'category_slug' => 'corydoras',
            ],
            [
                'common_name' => 'ROSE LINE BARB',
                'scientific_name' => 'Puntius denisonii',
                'length' => '10-15 cm',
                'image_path' => 'assets/fish/ROSE LINE BARB.png',
                'category_slug' => 'barb',
            ],
            [
                'common_name' => 'SNOWBALL SHRIMP',
                'scientific_name' => 'Neocaridina cf zhangjiajiensis',
                'length' => '2-3 cm',
                'image_path' => 'assets/fish/SNOWBALL SHRIMP.png',
                'category_slug' => 'shrimp',
            ],
        ];

        foreach ($stocks as $stockData) {
            $categorySlug = $stockData['category_slug'];
            unset($stockData['category_slug']);

            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $stockData['category_id'] = $category->id;
            }

            StockList::updateOrCreate(
                ['common_name' => $stockData['common_name']],
                $stockData
            );
        }
    }
}
