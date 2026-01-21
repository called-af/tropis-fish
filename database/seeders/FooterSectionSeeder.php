<?php

namespace Database\Seeders;

use App\Models\FooterSection;
use Illuminate\Database\Seeder;

class FooterSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'type' => 'company',
                'title' => 'Company Info',
                'description' => 'Premium quality tropical ornamental fish supplier for your aquarium',
                'links' => [],
                'copyright_text' => 'All rights reserved',
                'order' => 0,
                'is_active' => true,
            ],
            [
                'type' => 'menu',
                'title' => 'Menu',
                'description' => null,
                'links' => [
                    ['text' => 'Home', 'url' => '/'],
                    ['text' => 'Company Profile', 'url' => '/#company-profile'],
                    ['text' => 'Stock List', 'url' => '/#stock-list'],
                    ['text' => 'Gallery', 'url' => '/#gallery'],
                ],
                'copyright_text' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'type' => 'information',
                'title' => 'Information',
                'description' => null,
                'links' => [
                    ['text' => 'How to Order', 'url' => '#'],
                    ['text' => 'Privacy Policy', 'url' => '#'],
                    ['text' => 'Terms & Conditions', 'url' => '#terms'],
                ],
                'copyright_text' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'type' => 'social',
                'title' => 'Follow Us',
                'description' => null,
                'links' => [
                    ['text' => 'Facebook', 'url' => 'https://www.facebook.com/share/1JYUvRNZ1Q/', 'icon' => 'facebook'],
                    ['text' => 'Twitter', 'url' => '#', 'icon' => 'twitter'],
                    ['text' => 'Instagram', 'url' => '#', 'icon' => 'instagram'],
                ],
                'copyright_text' => null,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            FooterSection::updateOrCreate(
                ['type' => $section['type']],
                $section
            );
        }
    }
}
