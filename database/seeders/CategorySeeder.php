<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Loach Fish',
                'description' => 'Collection of freshwater loach fish species.',
                'detail_title' => 'Loach Fish',
                'detail_description' => 'Includes Black Kuhlii, Clown Loach, and Pakistani Botia.',
                'image_path' => 'categories/loach-fish.jpg',
                'detail_image_path' => 'categories/loach-fish-detail.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Tetra Fish',
                'description' => 'Collection of colorful freshwater tetra fish.',
                'detail_title' => 'Tetra Fish',
                'detail_description' => 'Includes Neon Tetra, Cardinal Tetra, and Glowlight Tetra.',
                'image_path' => 'categories/tetra-fish.jpg',
                'detail_image_path' => 'categories/tetra-fish-detail.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Barb Fish',
                'description' => 'Collection of active freshwater barb fish.',
                'detail_title' => 'Barb Fish',
                'detail_description' => 'Includes Tiger Barb, Cherry Barb, and Odessa Barb.',
                'image_path' => 'categories/barb-fish.jpg',
                'detail_image_path' => 'categories/barb-fish-detail.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'slug' => Str::slug($category['name']),
                    'description' => $category['description'],
                    'image_path' => $category['image_path'],
                    'detail_title' => $category['detail_title'],
                    'detail_description' => $category['detail_description'],
                    'detail_image_path' => $category['detail_image_path'],
                    'sort_order' => $category['sort_order'],
                    'is_active' => $category['is_active'],
                ]
            );
        }
    }
}