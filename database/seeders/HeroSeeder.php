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
                'youtube_url' => 'https://youtu.be/HHi8qOtHnhE?si=CjtcMLsaqAbbZfQ7',
                'courtesy_text' => 'comadyret',
                'order' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($heroes as $hero) {
            Hero::create($hero);
        }
    }
}
