@props(['stockLists' => [], 'downloadLink' => null])

<section id="products" class="py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-1000 ease-out"
        >
            <x-molecules.section-header
                title="Stock List"
                description="The finest selection of ornamental fish with premium breeding quality"
            />
        </div>

        @if($stockLists && $stockLists->count() > 0)
            <div
                x-data="{ visible: false }"
                x-intersect:enter="visible = true"
                x-intersect:leave="visible = false"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out delay-200 grid sm:grid-cols-2 lg:grid-cols-3 gap-8"
            >
                @foreach($stockLists as $stock)
                    <x-molecules.product-card
                        :code="$stock->code"
                        :scientificName="$stock->scientific_name"
                        :commonName="$stock->common_name"
                        :size="$stock->size"
                        :length="$stock->length"
                        :image="$stock->image_path ? asset('storage/' . $stock->image_path) : null"
                    />
                @endforeach
            </div>
        @else
            {{-- Fallback when no data --}}
            <div
                x-data="{ visible: false }"
                x-intersect:enter="visible = true"
                x-intersect:leave="visible = false"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out delay-200"
            >
                <div class="bg-gray-900/50 backdrop-blur-sm rounded-2xl border-2 border-amber-500/30 p-16 text-center">
                    <div class="flex flex-col items-center gap-4">
                        <div class="w-20 h-20 bg-amber-500/10 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Stock List Coming Soon</h3>
                            <p class="text-gray-400">
                                We're currently updating our inventory. Please check back soon for our latest fish stock.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="text-center mt-16 space-y-6">
            <x-atoms.button variant="outline" href="{{ route('stock-list') }}">
                View All Stock
            </x-atoms.button>

            {{-- Download Link --}}
            @if($downloadLink)
                <div class="flex items-center justify-center gap-2 text-gray-300">
                    <span>For download the complete list,</span>
                    <a href="{{ $downloadLink }}" target="_blank" class="text-amber-500 hover:text-amber-500 font-semibold underline decoration-2 underline-offset-4 transition inline-flex items-center gap-1">
                        click here
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
