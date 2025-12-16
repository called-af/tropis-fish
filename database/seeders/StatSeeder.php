<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            [
                'label' => 'Years of Experience',
                'value' => '25+',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'Fish Species',
                'value' => '500+',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'label' => 'Fish Tanks',
                'value' => '3000+',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'label' => 'Happy Customers',
                'value' => '10K+',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            Stat::create($stat);
        }
    }
}
