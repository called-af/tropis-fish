@props(['stockLists' => [], 'downloadLink' => null])

<section id="stock-list" class="py-24 px-4 sm:px-6 lg:px-8 w-full">
    {{-- Anchor point for stock-list navigation --}}
    <div id="stock-list" class="absolute -top-24"></div>
    <div class="max-w-7xl w-full mx-auto">
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
                x-data="{ viewMode: 'grid' }"
                class="mt-12"
            >
                {{-- Search Bar --}}
                <div class="mb-8">
                    <div class="max-w-2xl mx-auto">
                        <div class="relative">
                            <input
                                type="text"
                                wire:model.live.debounce.300ms="search"
                                placeholder="Search by code, name, or scientific name..."
                                class="w-full px-6 py-4 pl-12 bg-gray-900/50 backdrop-blur-sm border-2 border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-amber-500 transition-all duration-300"
                            />
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            @if($this->search)
                                <button
                                    wire:click="$set('search', '')"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-amber-500 transition"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                        @if($this->search)
                            <div class="mt-3 flex items-center justify-center gap-2">
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500/20 border border-amber-500/30 rounded-lg text-amber-500 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Search: "{{ $this->search }}"
                                    <button wire:click="$set('search', '')" class="hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- View Mode Toggle --}}
                <div class="flex justify-center gap-2 mb-8">
                    <button
                        @click="viewMode = 'grid'"
                        :class="viewMode === 'grid' ? 'bg-amber-500 border-amber-500 text-black scale-105' : 'bg-gray-800 border-gray-600 text-gray-400 hover:border-amber-500/50 hover:text-amber-500 scale-100'"
                        class="px-6 py-3 rounded-lg border transition-all duration-300"
                        title="Grid View"
                    >
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 transition-transform duration-300" :class="viewMode === 'grid' ? 'rotate-180' : 'rotate-0'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <span class="font-semibold">Grid</span>
                        </div>
                    </button>
                    <button
                        @click="viewMode = 'table'"
                        :class="viewMode === 'table' ? 'bg-amber-500 border-amber-500 text-black scale-105' : 'bg-gray-800 border-gray-600 text-gray-400 hover:border-amber-500/50 hover:text-amber-500 scale-100'"
                        class="px-6 py-3 rounded-lg border transition-all duration-300"
                        title="Table View"
                    >
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 transition-transform duration-300" :class="viewMode === 'table' ? 'rotate-180' : 'rotate-0'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <span class="font-semibold">Table</span>
                        </div>
                    </button>
                </div>

                {{-- Grid View - Max 8 Items per page --}}
                <div x-show="viewMode === 'grid'" x-cloak>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($stockLists as $index => $stock)
                            <div
                                x-data="{ visible: false }"
                                x-intersect:enter="visible = true"
                                :class="visible ? 'opacity-100 translate-y-0 rotate-0 scale-100' : 'opacity-0 translate-y-12 rotate-3 scale-90'"
                                class="transition-all duration-700 ease-out"
                                style="transition-delay: {{ $index * 80 }}ms"
                            >
                                <div class="transform transition-transform duration-300">
                                    <x-molecules.product-card
                                        :code="$stock->code"
                                        :scientificName="$stock->scientific_name"
                                        :commonName="$stock->common_name"
                                        :size="$stock->size"
                                        :length="$stock->length"
                                       :image="$stock->image_path ? asset('storage/' . $stock->image_path) : null"
                                    />
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-8">
                        {{ $stockLists->links() }}
                    </div>
                </div>

                {{-- Table View - Scrollable --}}
                <div x-show="viewMode === 'table'" x-cloak>
                    <div class="bg-gray-900/50 backdrop-blur-sm rounded-2xl border border-gray-700 overflow-hidden">
                        {{-- Table Header Info --}}
                        <div class="px-6 py-4 border-b border-gray-700 bg-gray-800/30">
                            <p class="text-gray-400 text-center">
                                Total: <span class="text-amber-500 font-semibold">{{ $stockLists->count() }}</span> fish available
                            </p>
                        </div>

                        {{-- Scrollable Table Container --}}
                        <div class="overflow-x-auto max-h-[600px] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-800">
                            <table class="w-full">
                                <thead class="bg-gray-800/70 border-b border-gray-700 sticky top-0 z-10">
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
                                        <tr class="hover:bg-gray-800/50 transition-colors">
                                            {{-- Image --}}
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-800">
                                                    @if($stock->image_path)
                                                        <img
                                                            src="{{ asset("storage/{$stock->image_path}") }}"
                                                            alt="{{ $stock->common_name }}"
                                                            class="w-full h-full object-cover">
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
                                                        <span class="text-sm font-semibold">{{ $stock->length }}</span>
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

                        {{-- Table Footer --}}
                        <div class="px-6 py-4 border-t border-gray-700 bg-gray-800/50">
                            <p class="text-gray-400 text-center text-sm">
                                <svg class="w-4 h-4 inline-block text-amber-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Scroll down to see more fish
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
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
                            @if($this->search)
                                <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @else
                                <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            @if($this->search)
                                <h3 class="text-xl font-bold text-white mb-2">No Fish Found</h3>
                                <p class="text-gray-400 mb-4">
                                    We couldn't find any fish matching "{{ $this->search }}".<br>
                                    Try adjusting your search terms.
                                </p>
                                <button
                                    wire:click="$set('search', '')"
                                    class="px-6 py-3 bg-amber-500-600 text-black font-semibold rounded-xl transition inline-flex items-center gap-2"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Clear Search
                                </button>
                            @else
                                <h3 class="text-xl font-bold text-white mb-2">Stock List Coming Soon</h3>
                                <p class="text-gray-400">
                                    We're currently updating our inventory. Please check back soon for our latest fish stock.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Download Link --}}
        @if($downloadLink)
            <div class="mt-12 text-center">
                <div class="flex items-center justify-center gap-2 text-gray-300">
                    <span>For download the complete list,</span>
                    <a href="{{ $downloadLink }}" target="_blank" class="text-amber-500 hover:text-amber-600 font-semibold underline decoration-2 underline-offset-4 transition inline-flex items-center gap-1">
                        click here
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    [x-cloak] { display: none !important; }
</style>
