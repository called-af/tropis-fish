<div class="min-h-screen bg-gradient-to-b from-blue-400 via-blue-600 via-blue-900 to-black">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Product Detail Section --}}
    <section class="pt-40 pb-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{-- Back Button --}}
            <a href="{{ route('stock-list') }}" class="inline-flex items-center gap-2 text-amber-500 hover:text-amber-400 mb-8 transition-colors group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Stock List
            </a>

            <div class="grid lg:grid-cols-2 gap-12">
                {{-- Image Section --}}
                <div class="space-y-4">
                    {{-- Main Image with Border Amber --}}
                    <div class="aspect-square bg-blue-950/30 backdrop-blur-sm rounded-lg overflow-hidden border border-amber-500/40 shadow-2xl shadow-amber-500/30 hover:border-amber-500/60 hover:shadow-amber-500/40 transition-all duration-300">
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-900/20 to-blue-950/40">
                            <svg class="w-48 h-48 text-amber-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Thumbnail Gallery --}}
                    <div class="grid grid-cols-4 gap-4">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="aspect-square bg-blue-950/30 backdrop-blur-sm rounded-lg overflow-hidden border border-amber-500/30 hover:border-amber-500/50 hover:shadow-lg hover:shadow-amber-500/20 transition-all duration-300 cursor-pointer">
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-900/20 to-blue-950/40">
                                    <svg class="w-12 h-12 text-amber-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                {{-- Product Info Section --}}
                <div class="space-y-8">
                    {{-- Badges --}}
                    <div class="flex gap-3">
                        <span class="px-4 py-2 bg-amber-500/90 backdrop-blur-sm text-black rounded-md text-sm font-bold shadow-lg shadow-amber-500/30">
                            ARW-010
                        </span>
                        <span class="px-4 py-2 bg-blue-950/40 backdrop-blur-sm border border-amber-500/50 text-amber-400 rounded-md text-sm font-bold">
                            Large
                        </span>
                        <span class="px-4 py-2 bg-green-600/80 backdrop-blur-sm text-white rounded-md text-sm font-bold shadow-lg shadow-green-600/20">
                            In Stock
                        </span>
                    </div>

                    {{-- Product Name --}}
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 drop-shadow-lg">
                            Arwana Super Red
                        </h1>
                        <p class="text-xl text-gray-300 italic">
                            Scleropages formosus
                        </p>
                    </div>

                    {{-- Specifications --}}
                    <div class="bg-blue-950/20 backdrop-blur-md border border-amber-500/30 rounded-lg p-6 space-y-4 shadow-xl shadow-amber-500/10">
                        <h3 class="text-xl font-bold text-amber-400 mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Specifications
                        </h3>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-900/20 backdrop-blur-sm rounded-lg p-4 border border-amber-500/20 hover:border-amber-500/40 transition-colors">
                                <div class="text-amber-400 text-sm mb-1">Length</div>
                                <div class="text-white text-2xl font-bold">45 cm</div>
                            </div>
                            <div class="bg-blue-900/20 backdrop-blur-sm rounded-lg p-4 border border-amber-500/20 hover:border-amber-500/40 transition-colors">
                                <div class="text-amber-400 text-sm mb-1">Size Category</div>
                                <div class="text-white text-2xl font-bold">Large</div>
                            </div>
                            <div class="bg-blue-900/20 backdrop-blur-sm rounded-lg p-4 border border-amber-500/20 hover:border-amber-500/40 transition-colors">
                                <div class="text-amber-400 text-sm mb-1">Water Type</div>
                                <div class="text-white text-lg font-bold">Freshwater</div>
                            </div>
                            <div class="bg-blue-900/20 backdrop-blur-sm rounded-lg p-4 border border-amber-500/20 hover:border-amber-500/40 transition-colors">
                                <div class="text-amber-400 text-sm mb-1">Temperature</div>
                                <div class="text-white text-lg font-bold">24-30°C</div>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <h3 class="text-xl font-bold text-amber-400 mb-4">Description</h3>
                        <p class="text-gray-200 leading-relaxed">
                            The Super Red Arwana is one of the most sought-after ornamental fish in the world.
                            Known for its brilliant red coloration and majestic appearance, this fish is a symbol
                            of prosperity and good fortune in Asian culture. Our breeding program ensures the highest
                            quality specimens with vibrant colors and excellent health.
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-4">
                        <x-atoms.button variant="primary" class="flex-1">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Contact for Order
                            </span>
                        </x-atoms.button>
                        <x-atoms.button variant="outline">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </x-atoms.button>
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            <div class="mt-24">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-amber-500 mb-4">
                        Related Products
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto"></div>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
                </div>
            </div>
        </div>
    </section>

    <x-organisms.footer />
</div>
