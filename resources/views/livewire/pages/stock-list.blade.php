<div class="min-h-screen bg-gradient-to-b from-blue-400 via-blue-600 via-blue-900 to-black">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Hero Section --}}
    <section class="pt-40 pb-16 px-4 sm:px-6 lg:px-8 border-b border-white/5">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-light text-white mb-6 tracking-tight">Stock List</h1>
            <div class="w-20 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mb-6"></div>
            <p class="text-lg text-gray-400 font-light">Browse Our Complete Fish Collection</p>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if($stockLists->count() > 0 || $search)
                {{-- Table Container --}}
                <div class="bg-gray-900/50 backdrop-blur-sm rounded-2xl border border-gray-700 overflow-hidden">
                    {{-- Search Bar Header --}}
                    <div class="p-6 border-b border-gray-700 bg-gray-800/50">
                        <x-atoms.search-input
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search by code, name, or scientific name..."
                        />

                        {{-- Active Search Display --}}
                        @if($search)
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500/20 border border-amber-500/30 rounded-lg text-amber-300 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Search: "{{ $search }}"
                                    <button wire:click="$set('search', '')" class="hover:text-amber-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        @endif
                    </div>

                    @if($stockLists->count() > 0)
                        {{-- Results Count --}}
                        <div class="px-6 py-4 border-b border-gray-700 bg-gray-800/30">
                            <p class="text-gray-400 text-center">
                                Showing <span class="text-amber-400 font-semibold">{{ $stockLists->firstItem() }} - {{ $stockLists->lastItem() }}</span>
                                of <span class="text-amber-400 font-semibold">{{ $stockLists->total() }}</span> fish
                            </p>
                        </div>

                        {{-- Stock Grid Inside Table --}}
                        <div class="p-6">
                            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($stockLists as $index => $stock)
                                    <div
                                        wire:key="stock-{{ $stock->id }}"
                                        x-data="{ visible: false }"
                                        x-intersect:enter="visible = true"
                                        x-intersect:leave="visible = false"
                                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                                        class="transition-all duration-700 ease-out"
                                        style="transition-delay: {{ $index * 50 }}ms"
                                    >
                                        <x-molecules.product-card
                                            :code="$stock->code"
                                            :scientificName="$stock->scientific_name"
                                            :commonName="$stock->common_name"
                                            :size="$stock->size"
                                            :length="$stock->length"
                                            :image="$stock->image_path ? asset('storage/' . $stock->image_path) : null"
                                        />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Pagination --}}
                        @if($stockLists->hasPages())
                            <div class="px-6 py-4 border-t border-gray-700 bg-gray-800/30">
                                <div class="flex justify-center">
                                    {{ $stockLists->links() }}
                                </div>
                            </div>
                        @endif

                        {{-- Download Link Section --}}
                        @if($downloadLink)
                            <div class="px-6 py-6 border-t border-gray-700 bg-gray-800/50">
                                <div class="flex items-center justify-center gap-2 text-gray-300">
                                    <span>For download the complete list,</span>
                                    <a href="{{ $downloadLink }}" target="_blank" class="text-amber-400 hover:text-amber-300 font-semibold underline decoration-2 underline-offset-4 transition inline-flex items-center gap-1">
                                        click here
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @else
                        {{-- No Results in Table --}}
                        <div class="p-16 text-center">
                            <div class="flex flex-col items-center gap-6">
                                <div class="w-24 h-24 bg-amber-500/10 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-3">No Fish Found</h3>
                                    <p class="text-gray-400 mb-6">
                                        We couldn't find any fish matching your search criteria.<br>
                                        Try adjusting your search terms.
                                    </p>
                                    <button
                                        wire:click="$set('search', '')"
                                        class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-black font-semibold rounded-xl transition inline-flex items-center gap-2"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Clear Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                {{-- Empty State --}}
                <div class="py-24">
                    <div class="bg-gray-900/50 backdrop-blur-sm rounded-2xl border-2 border-amber-500/30 p-16 text-center max-w-2xl mx-auto">
                        <div class="flex flex-col items-center gap-6">
                            <div class="w-24 h-24 bg-amber-500/10 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($search)
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    @endif
                                </svg>
                            </div>
                            <div>
                                @if($search)
                                    <h3 class="text-2xl font-bold text-white mb-3">No Fish Found</h3>
                                    <p class="text-gray-400 mb-6">
                                        We couldn't find any fish matching your search criteria.<br>
                                        Try adjusting your search terms.
                                    </p>
                                    <button
                                        wire:click="$set('search', '')"
                                        class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-black font-semibold rounded-xl transition inline-flex items-center gap-2"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Clear Search
                                    </button>
                                @else
                                    <h3 class="text-2xl font-bold text-white mb-3">Stock List Coming Soon</h3>
                                    <p class="text-gray-400">
                                        We're currently updating our inventory.<br>
                                        Please check back soon for our latest fish stock.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <x-organisms.footer />
</div>
