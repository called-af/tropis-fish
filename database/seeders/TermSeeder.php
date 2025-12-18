<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $terms = [
            [
                'title' => 'Price',
                'content' => 'All the prices quote here is F.O.B from Jakarta – Indonesia, with US Dollar (USD). The prices can be changed anytime without prior notice.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Delivery Order',
                'content' => 'A minimum of 7 (seven) days order notice prior to shipment as highly advisable to ensure proper conditioning of fishes. For the seasonal fishes, please inquire ordering to ensuring the availability.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Packing',
                'content' => "All fishes are packing in double plastic bags. Our packing bag and box are IATA standard, and we use styrofoam, plastic bag, and carton box for packing.\n\nOne box normally content of 4 bags with double plastic bags for safety with box dimension 60 x 40 x 32cm, and have another box also which could content of 6 bags, with box dimension 75 x 40 x 32cm.",
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Dimension',
                'content' => "We use two types of boxes, there are:\n\n1) 60 x 40 x 32 cm\nActual weight 15kgs for freshwater fishes. Estimated weight 14-16 kgs (4 bags).\n\n2) 75 x 40 x 32 cm\nActual weight 17kgs. Estimated weight 17-20kgs (6 bags).\n\nFor total weight of boxes, it depends of the weight of fishes, and packing density for each box.",
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Claim for D.O.A.',
                'content' => 'Complain only received within 24 hours after the shipment arrival. Any shipment without news in 24 hours after the arrival, must be accepted well by consignee.',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Payment',
                'content' => 'For new buyer, advance payment in full is required prior to shipment. Credit terms can be negotiated upon the establishment of regular business.',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($terms as $term) {
            Term::updateOrCreate(
                ['title' => $term['title']],
                $term
            );
        }
    }
}
