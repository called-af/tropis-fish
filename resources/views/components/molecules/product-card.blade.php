{{--
    Example Usage:

    <x-molecules.product-card
        code="ARW-001"
        scientificName="Scleropages formosus"
        commonName="Arwana Super Red"
        size="Large"
        length="45"
        image="/images/fish/arwana.jpg"
    />

    Example Array Data:

    $products = [
        [
            'code' => 'ARW-001',
            'scientificName' => 'Scleropages formosus',
            'commonName' => 'Arwana Super Red',
            'size' => 'Large',
            'length' => '45',
            'image' => '/images/fish/arwana.jpg'
        ],
        [
            'code' => 'DIS-002',
            'scientificName' => 'Symphysodon aequifasciatus',
            'commonName' => 'Discus Blue Diamond',
            'size' => 'Medium',
            'length' => '15',
            'image' => '/images/fish/discus.jpg'
        ],
        [
            'code' => 'KOI-003',
            'scientificName' => 'Cyprinus carpio',
            'commonName' => 'Koi Kohaku',
            'size' => 'Extra Large',
            'length' => '60',
            'image' => '/images/fish/koi.jpg'
        ],
        [
            'code' => 'GLD-004',
            'scientificName' => 'Carassius auratus',
            'commonName' => 'Goldfish Ranchu',
            'size' => 'Small',
            'length' => '10',
            'image' => '/images/fish/goldfish.jpg'
        ],
        [
            'code' => 'OSC-005',
            'scientificName' => 'Astronotus ocellatus',
            'commonName' => 'Oscar Tiger',
            'size' => 'Medium',
            'length' => '25',
            'image' => '/images/fish/oscar.jpg'
        ],
        [
            'code' => 'LHN-006',
            'scientificName' => 'Pterophyllum scalare',
            'commonName' => 'Louhan Kamfa',
            'size' => 'Large',
            'length' => '30',
            'image' => '/images/fish/louhan.jpg'
        ]
    ];

    Usage in Blade Loop:

    @foreach($products as $product)
        <x-molecules.product-card
            :code="$product['code']"
            :scientificName="$product['scientificName']"
            :commonName="$product['commonName']"
            :size="$product['size']"
            :length="$product['length']"
            :image="$product['image']"
        />
    @endforeach
--}}

@props(['code' => null, 'scientificName' => null, 'commonName', 'size' => null, 'length' => null, 'image' => null, 'href' => null])

<a href="{{ $href ?? ($code ? route('product-detail', ['code' => $code]) : '#') }}" class="block group relative bg-gray-900/50 backdrop-blur-sm rounded-lg overflow-hidden border-2 border-amber-500 hover:border-amber-400 hover:shadow-2xl hover:shadow-amber-500/20 transition-all duration-300 transform hover:-translate-y-1">
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
        <h3 class="font-bold text-base text-white mb-1 line-clamp-1 group-hover:text-amber-400 transition-colors">
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
                <span class="text-xs font-semibold">{{ $length }} cm</span>
            </div>
        @endif

        <!-- View Details Button -->
        <x-atoms.button variant="primary" class="w-full text-xs py-1.5">
            <span class="flex items-center justify-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                View Details
            </span>
        </x-atoms.button>
    </div>
</a>
