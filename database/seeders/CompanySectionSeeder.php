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
                'subtitle' => 'State-of-the-Art Facilities Across Strategic Locations',
                'main_description_1' => 'Our facilities are strategically located across West Java to ensure optimal fish breeding, health management, and efficient distribution. Each location is equipped with modern infrastructure and managed by experienced professionals.',
                'main_description_2' => 'We have hundreds of aquarium and tanks to cover all of our fishes stocks. Besides, we have many other facilities to support us in doing business and ensuring the best care for our aquatic life.',
                'main_title_1' => 'Strategic Locations',
                'main_title_2' => 'Extensive Infrastructure',
                'images' => [],
                'image_layout' => 'slider',
                'content_blocks' => [
                    [
                        'title' => 'Cibitung - Main Office & Quarantine Facility',
                        'description' => 'Our main office and quarantine facility is located in Cibitung, Bekasi. This central hub serves as our primary operation center, featuring state-of-the-art quarantine systems to ensure all fish are healthy and disease-free before shipment. The facility is strategically positioned near Jakarta for efficient logistics and international shipping.',
                    ],
                    [
                        'title' => 'Bogor - Breeding Facility',
                        'description' => 'Our specialized breeding facility in Bogor is dedicated to cultivating high-quality ornamental fish. With optimal water conditions and carefully controlled environments, this location focuses on breeding various species of tropical fish. The natural surroundings and superior water quality make it an ideal location for fish reproduction and early-stage development.',
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
            CompanySection::updateOrCreate(
                ['type' => $section['type']],
                $section
            );
        }
    }
}
