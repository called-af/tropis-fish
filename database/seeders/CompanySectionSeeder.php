<?php

namespace Database\Seeders;

use App\Models\CompanySection;
use Illuminate\Database\Seeder;

class CompanySectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'type' => 'about',
                'title' => 'Company Profile',
                'subtitle' => 'Leading Ornamental Fish Exporter',
                'main_description_1' => 'PT. Tropis Fish was established in 1986, and has exported to South East Asia, Middle East, Europe, and USA since 2005. We are the specialist for export ornamental fishes, Invertebrates, and Aquatic Plants.',
                'main_description_2' => 'Our fishes collection consist of Indonesian origin fishes as well as from overseas such as Clown Loach, Brackish Fishes, Scats Fishes, many kinds of Tetra Fishes, Angel Fishes, Barb Fishes, Catfishes, Cichlids, Gar Fishes, Killie Fishes, Metynis, Ancient Fishes, Rasboras, Rainbows, Mollies, Platys, Guppies, Various Shrimps, Lobsters, Crabs, Snails, and Clams.',
                'main_title_1' => 'Established in 1986',
                'main_title_2' => 'Extensive Collection',
                'images' => [],
                'image_layout' => 'slider',
                'content_blocks' => [
                    [
                        'title' => 'Established in 1986',
                        'description' => 'PT. Tropis Fish was established in 1986, and has exported to South East Asia, Middle East, Europe, and USA since 2005. We are the specialist for export ornamental fishes, Invertebrates, and Aquatic Plants.',
                    ],
                    [
                        'title' => 'Extensive Collection',
                        'description' => 'Our fishes collection consist of Indonesian origin fishes as well as from overseas such as Clown Loach, Brackish Fishes, Scats Fishes, many kinds of Tetra Fishes, Angel Fishes, Barb Fishes, Catfishes, Cichlids, Gar Fishes, Killie Fishes, Metynis, Ancient Fishes, Rasboras, Rainbows, Mollies, Platys, Guppies, Various Shrimps, Lobsters, Crabs, Snails, and Clams.',
                    ],
                ],
                'process_steps' => null,
                'is_active' => true,
            ],
            [
                'type' => 'farm',
                'title' => 'Our Farm',
                'subtitle' => 'State-of-the-Art Facilities in Bekasi',
                'main_description_1' => 'Our Fishes Farm is located in Bekasi, it is a small suburban city near Jakarta. This strategic location allows us to efficiently manage our operations and expedite shipments worldwide.',
                'main_description_2' => 'We have hundreds of aquarium and tanks to cover all of our fishes stocks. Besides, we have many other facilities to support us in doing business and ensuring the best care for our aquatic life.',
                'main_title_1' => 'Strategic Location',
                'main_title_2' => 'Extensive Infrastructure',
                'images' => [],
                'image_layout' => 'slider',
                'content_blocks' => [
                    [
                        'title' => 'Strategic Location',
                        'description' => 'Our Fishes Farm is located in Bekasi, it is a small suburban city near Jakarta. This strategic location allows us to efficiently manage our operations and expedite shipments worldwide.',
                    ],
                    [
                        'title' => 'Extensive Infrastructure',
                        'description' => 'We have hundreds of aquarium and tanks to cover all of our fishes stocks. Besides, we have many other facilities to support us in doing business and ensuring the best care for our aquatic life.',
                    ],
                ],
                'process_steps' => null,
                'is_active' => true,
            ],
            [
                'type' => 'quality',
                'title' => 'Quality Control',
                'subtitle' => 'Ensuring Excellence in Every Shipment',
                'main_description_1' => 'We only supply high quality of tropical fishes and we are very concern about size, because that is make more value for our customers.',
                'main_description_2' => 'After we check in the quality control room, the fishes will be brought into the special area (quarantine area) to process before the shipment.',
                'main_title_1' => 'High Quality Standards',
                'main_title_2' => 'Rigorous Inspection Process',
                'images' => [],
                'image_layout' => 'slider',
                'content_blocks' => [
                    [
                        'title' => 'High Quality Standards',
                        'description' => 'We only supply high quality of tropical fishes and we are very concern about size, because that is make more value for our customers.',
                    ],
                    [
                        'title' => 'Rigorous Inspection Process',
                        'description' => 'After we check in the quality control room, the fishes will be brought into the special area (quarantine area) to process before the shipment.',
                    ],
                ],
                'process_steps' => [
                    [
                        'number' => '1',
                        'title' => 'Initial Selection',
                        'description' => 'Careful selection of healthy specimens',
                    ],
                    [
                        'number' => '2',
                        'title' => 'Quality Control Room',
                        'description' => 'Thorough health and size inspection',
                    ],
                    [
                        'number' => '3',
                        'title' => 'Quarantine Area',
                        'description' => 'Special care before shipment',
                    ],
                    [
                        'number' => '4',
                        'title' => 'Final Preparation',
                        'description' => 'Ready for safe shipment worldwide',
                    ],
                ],
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            CompanySection::create($section);
        }
    }
}
