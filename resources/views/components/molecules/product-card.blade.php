@props(['scientificName' => null, 'commonName', 'length' => null, 'image' => null, 'href' => null])

<div class="block group relative bg-gray-900/50 backdrop-blur-sm  overflow-hidden border-1 border-amber-500 hover:border-amber-400 hover:shadow-2xl hover:shadow-amber-500/20 transition-all duration-300 transform hover:-translate-y-1">
    <!-- Image Container - Square and Large -->
    <div class="relative aspect-square bg-gray-800 overflow-hidden">
        @if($image)
            <img src="{{ $image }}" alt="{{ $commonName }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-32 h-32 text-amber-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif

        <!-- Gradient Overlay on Hover -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </div>

    <!-- Content - Compact 10% area -->
    <div class="p-3 bg-gray-900/80 backdrop-blur-sm">
        <!-- Common Name -->
        <h3 class="font-bold text-base text-white mb-1 line-clamp-1 group-hover:text-amber-500 transition-colors">
            {{ $commonName }}
        </h3>

        <!-- Scientific Name -->
        @if($scientificName)
            <p class="text-xs text-gray-400 italic mb-2 line-clamp-1">
                {{ $scientificName }}
            </p>
        @endif

        <!-- Length Info - Compact -->
        @if($length)
            <div class="flex items-center gap-1 mb-3 text-gray-300">
                <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span class="text-xs font-semibold">{{ $length }}</span>
            </div>
        @endif

        <!-- Order Button -->
        <div class="mt-2">
            <a href="{{ route('home') }}#contact" class="flex items-center justify-center gap-2 w-full py-2 bg-amber-500 hover:bg-amber-600 text-black font-bold text-xs rounded transition-all duration-300 transform active:scale-95">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Order
            </a>
        </div>
    </div>
</div>
