<section class="py-20 relative overflow-hidden">
    {{-- Background - Darkest (pure black at bottom) --}}
    <div class="absolute inset-0 bg-gradient-to-b from-gray-950 to-black"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            {{-- Left Side: Text Content --}}
            <div class="space-y-8">
                {{-- Title --}}
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-amber-500 mb-4">Quality Control</h2>
                    <p class="text-xl text-gray-300">Ensuring Excellence in Every Shipment</p>
                </div>

                {{-- Text Content --}}
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">High Quality Standards</h3>
                            <p class="text-gray-300 leading-relaxed text-lg">
                                We only supply high quality of tropical fishes and we are very concern about size, because that is make more value for our customers.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">Rigorous Inspection Process</h3>
                            <p class="text-gray-300 leading-relaxed text-lg">
                                After we check in the quality control room, the fishes will be brought into the special area (quarantine area) to process before the shipment.
                            </p>
                        </div>
                    </div>

                    {{-- Quality Process Steps --}}
                    <div class="space-y-3 pt-4">
                        <h4 class="text-xl font-bold text-white mb-4">Our Process</h4>
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">1</div>
                            <div class="text-white pt-1">
                                <div class="font-semibold">Initial Selection</div>
                                <div class="text-sm text-gray-400">Careful selection of healthy specimens</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">2</div>
                            <div class="text-white pt-1">
                                <div class="font-semibold">Quality Control Room</div>
                                <div class="text-sm text-gray-400">Thorough health and size inspection</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">3</div>
                            <div class="text-white pt-1">
                                <div class="font-semibold">Quarantine Area</div>
                                <div class="text-sm text-gray-400">Special care before shipment</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">4</div>
                            <div class="text-white pt-1">
                                <div class="font-semibold">Final Preparation</div>
                                <div class="text-sm text-gray-400">Ready for safe shipment worldwide</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Side: Image Slider --}}
            <div>
                <x-molecules.image-slider
                    :images="[
                        [
                            'src' => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=800',
                            'alt' => 'Quality Control Room',
                            'title' => 'Quality Control',
                            'description' => 'Professional inspection process'
                        ],
                        [
                            'src' => 'https://images.unsplash.com/photo-1520990623178-dc3a6b1dd137?w=800',
                            'alt' => 'Quarantine Area',
                            'title' => 'Quarantine Facilities',
                            'description' => 'Special care before shipment'
                        ],
                        [
                            'src' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?w=800',
                            'alt' => 'Healthy Fish Stock',
                            'title' => 'Premium Stock',
                            'description' => 'Only the best quality fish'
                        ]
                    ]"
                    :interval="3000"
                    aspect-ratio="aspect-[4/3]"
                />
            </div>
        </div>
    </div>
</section>
