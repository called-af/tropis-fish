<div class="min-h-screen bg-blue-950">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Hero Section --}}
    <section class="pt-40 pb-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">Stock List</h1>
            <div class="w-20 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mb-6"></div>
            <p class="text-lg text-gray-100 font-medium">Browse Our Complete Fish Collection</p>
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
                        <div class="flex flex-col sm:flex-row gap-4">
                            {{-- Search Input --}}
                            <div class="flex-1">
                                <x-atoms.search-input
                                    wire:model.live.debounce.300ms="search"
                                    placeholder="Search by code, name, or scientific name..."
                                />
                            </div>

                            {{-- View Mode Toggle --}}
                            <div class="flex gap-2 shrink-0">
                                <button
                                    wire:click="setViewMode('grid')"
                                    class="px-4 py-2 rounded-lg border transition-all duration-300 {{ $viewMode === 'grid' ? 'bg-amber-500 border-amber-500 text-black' : 'bg-gray-800 border-gray-600 text-gray-400 hover:border-amber-500/50 hover:text-amber-500' }}"
                                    title="Grid View"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                </button>
                                <button
                                    wire:click="setViewMode('table')"
                                    class="px-4 py-2 rounded-lg border transition-all duration-300 {{ $viewMode === 'table' ? 'bg-amber-500 border-amber-500 text-black' : 'bg-gray-800 border-gray-600 text-gray-400 hover:border-amber-500/50 hover:text-amber-500' }}"
                                    title="Table View"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Active Search Display --}}
                        @if($search)
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500/20 border border-amber-500/30 rounded-lg text-amber-500 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Search: "{{ $search }}"
                                    <button wire:click="$set('search', '')" class="hover:text-white">
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
                                Showing <span class="text-amber-500 font-semibold">{{ $stockLists->firstItem() }} - {{ $stockLists->lastItem() }}</span>
                                of <span class="text-amber-500 font-semibold">{{ $stockLists->total() }}</span> fish
                            </p>
                        </div>

                        {{-- Grid or Table View --}}
                        @if($viewMode === 'grid')
                            {{-- Grid View --}}
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
                        @else
                            {{-- Table View --}}
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-800/70 border-b border-gray-700">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-amber-500 uppercase tracking-wider">Image</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-amber-500 uppercase tracking-wider">Code</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-amber-500 uppercase tracking-wider">Common Name</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-amber-500 uppercase tracking-wider">Scientific Name</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-amber-500 uppercase tracking-wider">Size</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-amber-500 uppercase tracking-wider">Length</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-700">
                                        @foreach($stockLists as $stock)
                                            <tr wire:key="stock-table-{{ $stock->id }}" class="hover:bg-gray-800/50 transition-colors">
                                                {{-- Image --}}
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-800">
                                                        @if($stock->image_path)
                                                            <img src="{{ asset('storage/' . $stock->image_path) }}" alt="{{ $stock->common_name }}" class="w-full h-full object-cover">
                                                        @else
                                                            <div class="w-full h-full flex items-center justify-center">
                                                                <svg class="w-8 h-8 text-amber-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                {{-- Code --}}
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-3 py-1 bg-amber-500 rounded-md text-xs font-bold text-black">
                                                        {{ $stock->code }}
                                                    </span>
                                                </td>
                                                {{-- Common Name --}}
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-semibold text-white">{{ $stock->common_name }}</div>
                                                </td>
                                                {{-- Scientific Name --}}
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-400 italic">{{ $stock->scientific_name ?? '-' }}</div>
                                                </td>
                                                {{-- Size --}}
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($stock->size)
                                                        <span class="px-3 py-1 bg-gray-800 border border-amber-500 rounded-md text-xs font-bold text-amber-500">
                                                            {{ $stock->size }}
                                                        </span>
                                                    @else
                                                        <span class="text-gray-500 text-sm">-</span>
                                                    @endif
                                                </td>
                                                {{-- Length --}}
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($stock->length)
                                                        <div class="flex items-center gap-1 text-gray-300">
                                                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                            </svg>
                                                            <span class="text-sm font-semibold">{{ $stock->length }} cm</span>
                                                        </div>
                                                    @else
                                                        <span class="text-gray-500 text-sm">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

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
                                    <a href="{{ $downloadLink }}" target="_blank" class="text-amber-500 hover:text-amber-500 font-semibold underline decoration-2 underline-offset-4 transition inline-flex items-center gap-1">
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
                                    <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    {{-- Terms Modal --}}
    <x-organisms.terms-modal />
</div>
