<section class="py-20 relative overflow-hidden">
    {{-- Background - Transitioning from blue to darker blue --}}
    <div class="absolute inset-0 bg-gradient-to-b from-blue-600 via-blue-700 to-blue-900"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            {{-- Left Side: Text Content --}}
            <div class="space-y-8">
                {{-- Title --}}
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-amber-500 mb-4">Company Profile</h2>
                    <p class="text-xl text-gray-300">Leading Ornamental Fish Exporter</p>
                </div>

                {{-- Text Content --}}
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">Established in 1986</h3>
                            <p class="text-gray-300 leading-relaxed text-lg">
                                PT. Tropis Fish was established in 1986, and has exported to South East Asia, Middle East, Europe, and USA since 2005. We are the specialist for export ornamental fishes, Invertebrates, and Aquatic Plants.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">Extensive Collection</h3>
                            <p class="text-gray-300 leading-relaxed text-lg">
                                Our fishes collection consist of Indonesian origin fishes as well as from overseas such as Clown Loach, Brackish Fishes, Scats Fishes, many kinds of Tetra Fishes, Angel Fishes, Barb Fishes, Catfishes, Cichlids, Gar Fishes, Killie Fishes, Metynis, Ancient Fishes, Rasboras, Rainbows, Mollies, Platys, Guppies, Various Shrimps, Lobsters, Crabs, Snails, and Clams.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">Quality & Competitive Prices</h3>
                            <p class="text-gray-300 leading-relaxed text-lg">
                                We also could supply for aquatic plants in our each shipment to you. We only have the highest quality stocks with competitive prices.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Side: Image Slider --}}
            <div>
                <x-molecules.image-slider
                    :images="[
                        [
                            'src' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?w=800',
                            'alt' => 'Tropical Fish Collection',
                            'title' => 'Premium Tropical Fish',
                            'description' => 'High-quality ornamental fish'
                        ],
                        [
                            'src' => 'https://images.unsplash.com/photo-1520990623178-dc3a6b1dd137?w=800',
                            'alt' => 'Aquarium Facility',
                            'title' => 'Modern Facilities',
                            'description' => 'State-of-the-art aquarium systems'
                        ],
                        [
                            'src' => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=800',
                            'alt' => 'Fish Care',
                            'title' => 'Expert Care',
                            'description' => 'Professional fish handling'
                        ]
                    ]"
                    :interval="3000"
                    aspect-ratio="aspect-[4/3]"
                />
            </div>
        </div>
    </div>
</section>
