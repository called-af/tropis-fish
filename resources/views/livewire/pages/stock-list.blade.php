<div class="min-h-screen bg-blue-950">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Hero Section --}}
    <section class="pt-40 pb-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">Categories</h1>
            <div class="w-20 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mb-6"></div>
            <p class="text-lg text-gray-100 font-medium">Browse Our Freshwater Fish Categories</p>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{-- Search Bar --}}
            <div class="mb-12 max-w-2xl mx-auto">
                <x-atoms.search-input
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search categories by name or description..."
                />
            </div>

            @if($categories->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
                    @foreach($categories as $index => $cat)
                        <div
                            wire:key="cat-{{ $cat->id }}"
                            x-data="{ visible: false }"
                            x-intersect:enter="visible = true"
                            :class="visible ? 'opacity-100 translate-y-0 scale-100' : 'opacity-0 translate-y-8 scale-95'"
                            class="transition-all duration-700 ease-out"
                            style="transition-delay: {{ $index * 80 }}ms"
                        >
                            <a href="{{ route('category.detail', $cat->slug) }}" class="block transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl hover:shadow-amber-500/10">
                                <x-molecules.category-card
                                    :name="$cat->name"
                                    :count="$cat->stock_lists_count"
                                    :image="$cat->image_path ? (str_starts_with($cat->image_path, 'assets/') ? asset($cat->image_path) : asset('storage/' . $cat->image_path)) : null"
                                />
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($categories->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $categories->links() }}
                    </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="py-12">
                    <div class="bg-gray-900/50 backdrop-blur-sm rounded-2xl border-2 border-amber-500/30 p-16 text-center max-w-2xl mx-auto">
                        <div class="flex flex-col items-center gap-6">
                            <div class="w-24 h-24 bg-amber-500/10 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3">No Categories Found</h3>
                                <p class="text-gray-400">
                                    We couldn't find any categories matching your search.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Download Link --}}
            @if($downloadLink)
                <div class="mt-16 text-center">
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

    <x-organisms.footer />

    {{-- Terms Modal --}}
    <x-organisms.terms-modal />
</div>
