<?php

namespace Database\Seeders;

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
                'code' => 'BG001',
                'common_name' => 'BLACK GHOST',
                'scientific_name' => 'Apteronotus albifrons',
                'size' => 'Large',
                'length' => '40-50 cm',
                'image_path' => 'assets/fish/BLACK GHOST.jpeg',
            ],
            [
                'code' => 'CL001',
                'common_name' => 'CLOWN LOACH',
                'scientific_name' => 'Chromobotia macracanthus',
                'size' => 'Medium',
                'length' => '15-20 cm',
                'image_path' => 'assets/fish/CLOWN LOACH.jpeg',
            ],
            [
                'code' => 'GNT001',
                'common_name' => 'GREEN NEON TETRA',
                'scientific_name' => 'Paracheirodon simulans',
                'size' => 'Small',
                'length' => '2-3 cm',
                'image_path' => 'assets/fish/GREEN NEON TETRA.png',
            ],
            [
                'code' => 'OMC001',
                'common_name' => 'ORANGE MINI MEXICAN CRAYFISH',
                'scientific_name' => 'Cambarellus patzcuarensis',
                'size' => 'Small',
                'length' => '3-4 cm',
                'image_path' => 'assets/fish/ORANGE MINI MEXICAN CRAYFISH.png',
            ],
            [
                'code' => 'ORS001',
                'common_name' => 'ORANGE RABBIT SNAIL',
                'scientific_name' => 'Tylomelania sp.',
                'size' => 'Medium',
                'length' => '5-8 cm',
                'image_path' => 'assets/fish/ORANGE RABBIT SNAIL.png',
            ],
            [
                'code' => 'PC001',
                'common_name' => 'PANDA CORYDORAS',
                'scientific_name' => 'Corydoras panda',
                'size' => 'Small',
                'length' => '4-5 cm',
                'image_path' => 'assets/fish/PANDA CORYDORAS.png',
            ],
            [
                'code' => 'RLB001',
                'common_name' => 'ROSE LINE BARB',
                'scientific_name' => 'Puntius denisonii',
                'size' => 'Small',
                'length' => '10-15 cm',
                'image_path' => 'assets/fish/ROSE LINE BARB.png',
            ],
            [
                'code' => 'SBS001',
                'common_name' => 'SNOWBALL SHRIMP',
                'scientific_name' => 'Neocaridina cf zhangjiajiensis',
                'size' => 'Small',
                'length' => '2-3 cm',
                'image_path' => 'assets/fish/SNOWBALL SHRIMP.png',
            ],
        ];

        foreach ($stocks as $stock) {
            StockList::updateOrCreate(
                ['common_name' => $stock['common_name']],
                $stock
            );
        }
    }
}
