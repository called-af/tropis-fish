<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourcePath = public_path('assets/banner-home1.jpg');
        $destinationDir = storage_path('app/public/about');
        $destinationPath = $destinationDir.'/banner-home1.jpg';

        if (! File::exists($destinationDir)) {
            File::makeDirectory($destinationDir, 0755, true);
        }

        if (File::exists($sourcePath) && ! File::exists($destinationPath)) {
            File::copy($sourcePath, $destinationPath);
        }

        AboutSection::create([
            'title' => 'About Us',
            'description_1' => 'Since 1986, we has been at the forefront of breeding and distributing premium quality tropical ornamental fish. With over two decades of experience, we have established ourselves as one of Indonesia\'s most trusted suppliers of aquatic life.',
            'description_2' => 'Our passion for aquatic excellence drives us to maintain the highest standards in fish breeding, health management, and customer service. We take pride in our commitment to sustainability and the well-being of every fish that leaves our facility.',
            'image_path' => 'about/banner-home1.jpg',
            'feature_1_title' => 'Premium Quality',
            'feature_1_description' => 'Carefully selected and quarantined fish',
            'feature_1_icon' => 'check-circle',
            'feature_2_title' => 'Best Prices',
            'feature_2_description' => 'Direct from our breeding center',
            'feature_2_icon' => 'currency-dollar',
            'feature_3_title' => 'Fast Delivery',
            'feature_3_description' => 'Professional packaging nationwide',
            'feature_3_icon' => 'truck',
            'feature_4_title' => 'Expert Care',
            'feature_4_description' => 'Dedicated team of specialists',
            'feature_4_icon' => 'heart',
            'is_active' => true,
            'order' => 0,
        ]);
    }
}
