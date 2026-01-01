@props(['code' => null, 'scientificName' => null, 'commonName', 'size' => null, 'length' => null, 'image' => null, 'href' => null])

<div class="block group relative bg-gray-900/50 backdrop-blur-sm  overflow-hidden border-1 border-amber-500 hover:border-amber-400 hover:shadow-2xl hover:shadow-amber-500/20 transition-all duration-300 transform hover:-translate-y-1">
    <!-- Code Badge -->
    @if($code)
        <div class="absolute top-3 left-3 z-10">
            <span class="px-3 py-1 bg-amber-500 rounded-md text-xs font-bold text-black">
                {{ $code }}
            </span>
        </div>
    @endif

    <!-- Size Badge -->
    @if($size)
        <div class="absolute top-3 right-3 z-10">
            <span class="px-3 py-1 bg-gray-900 border border-amber-500 rounded-md text-xs font-bold text-amber-500">
                {{ $size }}
            </span>
        </div>
    @endif

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
            <div class="flex items-center gap-1 mb-2 text-gray-300">
                <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span class="text-xs font-semibold">{{ $length }}</span>
            </div>
        @endif

        <!-- Available Badge -->
        <div class="flex items-center justify-center gap-2 text-xs text-amber-500 font-semibold">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Available in Stock
        </div>
    </div>
</div>
