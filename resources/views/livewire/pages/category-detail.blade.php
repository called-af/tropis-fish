@php
    $hero_img_url = $category->image_path 
        ? (str_starts_with($category->image_path, 'assets/') ? asset($category->image_path) : asset('storage/' . $category->image_path)) 
        : null;
        
    $detail_img_url = $category->detail_image_path 
        ? (str_starts_with($category->detail_image_path, 'assets/') ? asset($category->detail_image_path) : asset('storage/' . $category->detail_image_path)) 
        : null;
@endphp

<div class="min-h-screen bg-blue-950">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Hero Section --}}
<section class="relative px-4 sm:px-6 lg:px-8 overflow-hidden bg-slate-950 h-[580px] sm:h-[660px] flex items-end sm:items-center">
    {{-- Background Image --}}
    @if($hero_img_url)
        <div class="absolute inset-0 z-0">
            <img src="{{ $hero_img_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover opacity-50">
        </div>
    @else
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-slate-950 via-blue-950/60 to-slate-950"></div>
    @endif

    {{-- Decorative glows --}}
    <div class="absolute top-1/3 left-0 w-[500px] h-[500px] bg-amber-500/6 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-[400px] h-[400px] bg-blue-600/8 rounded-full blur-[120px] pointer-events-none"></div>

    {{-- Content --}}
    <div class="relative z-10 w-full max-w-6xl mx-auto pb-10 sm:pb-0">
        <div
            x-data="{ visible: false }"
            x-init="setTimeout(() => visible = true, 80)"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-1000 ease-out"
        >
            {{-- Badge --}}
            <div class="mb-4 sm:mb-6">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/25 uppercase tracking-[0.2em]">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    PT. Tropis Fish Indonesia
                </span>
            </div>

            {{-- Main Title --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white tracking-tight leading-tight mb-3 sm:mb-6 break-words">
                {{ $category->name }}
            </h1>

            {{-- Description — hidden on mobile, visible sm+ --}}
            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-white/90 font-light leading-relaxed max-w-2xl mb-8">
                @if($category->description)
                    {{ $category->description }}
                @else
                    Explore our premium {{ $category->name }} collection — each specimen carefully selected and quality-assured for global export standards.
                @endif
            </p>


        </div>
    </div>

    {{-- Bottom fade --}}
    <div class="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-blue-950 to-transparent pointer-events-none"></div>
</section>

    {{-- Category Profile Detail Section --}}
    <section class="relative py-16 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                {{-- Detail Image Column --}}
                <div class="lg:col-span-5 flex justify-center">
                    <div class="w-full max-w-md aspect-square overflow-hidden border border-gray-700 bg-gray-900">
                        @if($detail_img_url)
                            <img src="{{ $detail_img_url }}" alt="{{ $category->detail_title ?? $category->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-amber-500/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Detail Text Column --}}
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 text-amber-500 font-semibold text-sm uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        Category Spotlight
                    </div>
                    
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
                        {{ $category->detail_title ?? $category->name }}
                    </h2>
                    
                    <div class="h-1 w-20 bg-gradient-to-r from-amber-500 to-transparent rounded"></div>
                    
                    <p class="text-gray-300 text-base sm:text-lg font-light leading-relaxed">
                        {{ $category->detail_description ?? 'Learn more about this category. PT. Tropis Fish Indonesia supplies healthy, well-selected, and premium specimens suited for global standard requests.' }}
                    </p>
                </div>
            </div>
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
                                    placeholder="Search {{ $category->name }} by code, name, or scientific name..."
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
                                                :image="$stock->image_path ? (str_starts_with($stock->image_path, 'assets/') ? asset($stock->image_path) : asset('storage/' . $stock->image_path)) : null"
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
                                                            <img src="{{ str_starts_with($stock->image_path, 'assets/') ? asset($stock->image_path) : asset('storage/' . $stock->image_path) }}" alt="{{ $stock->common_name }}" class="w-full h-full object-cover">
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
                                        We couldn't find any fish matching your search criteria in this category.<br>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3">No Fish in this Category Yet</h3>
                                <p class="text-gray-400">
                                    We're currently updating our stock for this category.<br>
                                    Please check back soon for our latest items.
                                </p>
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
