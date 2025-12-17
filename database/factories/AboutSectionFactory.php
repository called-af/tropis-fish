<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutSection>
 */
class AboutSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'About Us',
            'description_1' => fake()->paragraph(3),
            'description_2' => fake()->paragraph(3),
            'image_path' => 'about/default.jpg',
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
        ];
    }
}
