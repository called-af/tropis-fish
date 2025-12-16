<section class="py-20">
    <div class="container mx-auto px-6">
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-1000 ease-out grid md:grid-cols-2 gap-16 items-center"
        >
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
            <div class="space-y-6">
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

                {{-- Quality Footage Button --}}
                <div class="pt-4">
                    <a href="{{ route('gallery') }}">
                        <x-atoms.button
                            variant="outline"
                            size="lg"
                        >
                            <div class="flex items-center gap-3">
                                <x-heroicon-o-video-camera class="w-6 h-6" />
                                <span>View Our Quality Footage</span>
                                <x-heroicon-o-arrow-right class="w-5 h-5" />
                            </div>
                        </x-atoms.button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
