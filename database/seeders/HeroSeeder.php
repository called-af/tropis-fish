<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroes = [
            [
                'title' => 'Premium Quality Ornamental Fish',
                'description' => 'Discover our extensive collection of high-quality ornamental fish, carefully bred and maintained to meet international standards.',
                'background_type' => 'youtube',
                'image_path' => null,
                'video_path' => null,
                'youtube_url' => 'https://youtu.be/hgRSWXJwja4?si=P3AloXxj2wuHSHKY',
                'courtesy_text' => '@AquaExplorer',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Worldwide Export Services',
                'description' => 'We export premium ornamental fish globally with professional packaging and fast delivery to ensure your fish arrive healthy and safe.',
                'background_type' => 'youtube',
                'image_path' => null,
                'video_path' => null,
                'youtube_url' => 'https://youtu.be/zQ8caaUxIvY?si=52ae0WIvLWc-YQ0i',
                'courtesy_text' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Trusted by Aquarium Enthusiasts',
                'description' => 'Join thousands of satisfied customers worldwide who trust PT. Tropis Fish Indonesia for their ornamental fish needs.',
                'background_type' => 'youtube',
                'image_path' => null,
                'video_path' => null,
                'youtube_url' => 'https://youtu.be/HHi8qOtHnhE?si=CjtcMLsaqAbbZfQ7',
                'courtesy_text' => 'comadyret',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($heroes as $hero) {
            Hero::create($hero);
        }
    }
}
