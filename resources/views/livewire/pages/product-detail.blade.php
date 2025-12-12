<div class="min-h-screen bg-gradient-to-b from-blue-400 via-blue-600 via-blue-900 to-black">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Product Detail Section --}}
    <section class="pt-40 pb-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{-- Back Button --}}
            <a href="{{ route('stock-list') }}" class="inline-flex items-center gap-2 text-orange-400 hover:text-orange-300 mb-8 transition-colors group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Stock List
            </a>

            <div class="grid lg:grid-cols-2 gap-12">
                {{-- Image Section --}}
                <div class="space-y-4">
                    {{-- Main Image --}}
                    <div class="aspect-square bg-white rounded-3xl overflow-hidden border-4 border-blue-500 shadow-2xl shadow-blue-500/20">
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-blue-50">
                            <x-heroicon-o-photo class="w-48 h-48 text-blue-300" />
                        </div>
                    </div>

                    {{-- Thumbnail Gallery --}}
                    <div class="grid grid-cols-4 gap-4">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="aspect-square bg-white rounded-xl overflow-hidden border-2 border-blue-400 hover:border-orange-500 transition-colors cursor-pointer">
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-white">
                                    <x-heroicon-o-photo class="w-12 h-12 text-blue-300" />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                {{-- Product Info Section --}}
                <div class="space-y-8">
                    {{-- Badges --}}
                    <div class="flex gap-3">
                        <span class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-bold shadow-lg">
                            ARW-010
                        </span>
                        <span class="px-4 py-2 bg-orange-600 text-white rounded-full text-sm font-bold shadow-lg">
                            Large
                        </span>
                        <span class="px-4 py-2 bg-green-600 text-white rounded-full text-sm font-bold shadow-lg">
                            In Stock
                        </span>
                    </div>

                    {{-- Product Name --}}
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">
                            Arwana Super Red
                        </h1>
                        <p class="text-xl text-blue-300 italic">
                            Scleropages formosus
                        </p>
                    </div>

                    {{-- Specifications --}}
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 space-y-4">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Specifications
                        </h3>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-900/30 rounded-xl p-4 border border-blue-500/30">
                                <div class="text-blue-400 text-sm mb-1">Length</div>
                                <div class="text-white text-2xl font-bold">45 cm</div>
                            </div>
                            <div class="bg-blue-900/30 rounded-xl p-4 border border-blue-500/30">
                                <div class="text-blue-400 text-sm mb-1">Size Category</div>
                                <div class="text-white text-2xl font-bold">Large</div>
                            </div>
                            <div class="bg-blue-900/30 rounded-xl p-4 border border-blue-500/30">
                                <div class="text-blue-400 text-sm mb-1">Water Type</div>
                                <div class="text-white text-lg font-bold">Freshwater</div>
                            </div>
                            <div class="bg-blue-900/30 rounded-xl p-4 border border-blue-500/30">
                                <div class="text-blue-400 text-sm mb-1">Temperature</div>
                                <div class="text-white text-lg font-bold">24-30°C</div>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Description
                        </h3>
                        <p class="text-gray-300 leading-relaxed">
                            The Super Red Arwana is one of the most sought-after ornamental fish in the world.
                            Known for its brilliant red coloration and majestic appearance, this fish is a symbol
                            of prosperity and good fortune in Asian culture. Our breeding program ensures the highest
                            quality specimens with vibrant colors and excellent health.
                        </p>
                    </div>

                    {{-- Care Requirements --}}
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Care Requirements
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-300">Minimum aquarium size: 200 liters</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-300">Diet: Carnivore - live food, pellets</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-300">pH level: 6.5 - 7.5</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-300">Behavior: Peaceful but requires spacious tank</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-4">
                        <button class="flex-1 bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 px-8 rounded-full shadow-xl shadow-orange-600/30 transition-all transform hover:scale-105 flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Contact for Order
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-full shadow-xl shadow-blue-600/30 transition-all transform hover:scale-105">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            <div class="mt-24">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-light text-white mb-4">
                        Related Products
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent mx-auto"></div>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <x-molecules.product-card
                        code="DIS-006"
                        scientificName="Symphysodon aequifasciatus"
                        commonName="Discus Blue Diamond"
                        size="Large"
                        length="18"
                    />
                    <x-molecules.product-card
                        code="OSC-011"
                        scientificName="Astronotus ocellatus"
                        commonName="Oscar Tiger"
                        size="Medium"
                        length="25"
                    />
                    <x-molecules.product-card
                        code="LHN-012"
                        scientificName="Cichlasoma trimaculatum"
                        commonName="Louhan Kamfa"
                        size="Large"
                        length="30"
                    />
                    <x-molecules.product-card
                        code="KOI-009"
                        scientificName="Cyprinus carpio"
                        commonName="Koi Kohaku"
                        size="Extra Large"
                        length="35"
                    />
                </div>
            </div>
        </div>
    </section>

    <x-organisms.footer />
</div>
