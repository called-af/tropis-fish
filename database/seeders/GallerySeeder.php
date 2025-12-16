<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            // Fish Gallery
            [
                'title' => 'Colorful Tropical Fish',
                'description' => 'Premium quality tropical fish from our farm',
                'image_path' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?w=800',
                'category' => 'fish',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Exotic Aquarium Fish',
                'description' => 'Wide variety of exotic species',
                'image_path' => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=800',
                'category' => 'fish',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Premium Ornamental Fish',
                'description' => 'High-grade ornamental fish collection',
                'image_path' => 'https://images.unsplash.com/photo-1520990623178-dc3a6b1dd137?w=800',
                'category' => 'fish',
                'order' => 3,
                'is_active' => true,
            ],

            // Farm Gallery
            [
                'title' => 'Main Farm Facility',
                'description' => 'Our state-of-the-art farm in Bekasi',
                'image_path' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?w=800',
                'category' => 'farm',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Aquarium Tanks',
                'description' => 'Hundreds of specialized aquarium systems',
                'image_path' => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=800',
                'category' => 'farm',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Care Facilities',
                'description' => 'Professional care and maintenance area',
                'image_path' => 'https://images.unsplash.com/photo-1520990623178-dc3a6b1dd137?w=800',
                'category' => 'farm',
                'order' => 3,
                'is_active' => true,
            ],

            // Quality Control Gallery
            [
                'title' => 'Quality Control Room',
                'description' => 'Professional inspection and grading',
                'image_path' => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=800',
                'category' => 'quality',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Quarantine Area',
                'description' => 'Special care before shipment',
                'image_path' => 'https://images.unsplash.com/photo-1520990623178-dc3a6b1dd137?w=800',
                'category' => 'quality',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Health Inspection',
                'description' => 'Rigorous health and quality checks',
                'image_path' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?w=800',
                'category' => 'quality',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
