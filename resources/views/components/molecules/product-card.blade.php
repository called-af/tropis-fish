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

<a href="{{ $href ?? ($code ? route('product-detail', ['code' => $code]) : '#') }}" class="block group relative bg-white rounded-3xl overflow-hidden border border-gray-200/60 hover:border-blue-300 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
    <!-- Code Badge -->
    @if($code)
        <div class="absolute top-4 left-4 z-10">
            <span class="px-3 py-1.5 bg-blue-600/90 backdrop-blur-md rounded-full text-xs font-bold text-white shadow-lg">
                {{ $code }}
            </span>
        </div>
    @endif

    <!-- Size Badge -->
    @if($size)
        <div class="absolute top-4 right-4 z-10">
            <span class="px-3 py-1 bg-green-500/90 backdrop-blur-md rounded-full text-xs font-bold text-white shadow-lg">
                {{ $size }}
            </span>
        </div>
    @endif

    <!-- Image Container -->
    <div class="relative aspect-square bg-gradient-to-br from-blue-50 via-white to-orange-50 overflow-hidden">
        @if($image)
            <img src="{{ $image }}" alt="{{ $commonName }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <x-heroicon-o-photo class="w-32 h-32 text-blue-300 group-hover:text-blue-400 transition-colors" />
            </div>
        @endif

        <!-- Gradient Overlay on Hover -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
    </div>

    <!-- Content -->
    <div class="p-6">
        <!-- Common Name -->
        <h3 class="font-bold text-xl text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
            {{ $commonName }}
        </h3>

        <!-- Scientific Name -->
        @if($scientificName)
            <p class="text-sm text-gray-500 italic mb-4">
                {{ $scientificName }}
            </p>
        @endif

        <!-- Length Info -->
        @if($length)
            <div class="flex items-center gap-2 mb-5 text-gray-700">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span class="text-sm font-semibold">Length: {{ $length }} cm</span>
            </div>
        @endif

        <x-atoms.button variant="primary" class="w-full group-hover:shadow-lg group-hover:scale-105 transition-all duration-300">
            <span class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Lihat Detail
            </span>
        </x-atoms.button>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute -bottom-2 -right-2 w-24 h-24 bg-gradient-to-br from-blue-200/20 to-orange-200/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
</a>
