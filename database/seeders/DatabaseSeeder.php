<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            SettingSeeder::class,
            HeroSeeder::class,
            CategorySeeder::class,
            StatSeeder::class,
            StockListSeeder::class,
            GallerySeeder::class,
            AboutSectionSeeder::class,
            CompanySectionSeeder::class,
            FooterSectionSeeder::class,
            TermSeeder::class,
        ]);
    }
}
