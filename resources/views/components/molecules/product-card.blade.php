@props(['name', 'price', 'image' => null])

<div class="bg-white rounded-2xl overflow-hidden border border-gray-200 hover:shadow-xl transition">
    <div class="aspect-square bg-gradient-to-br from-blue-100 to-orange-100 flex items-center justify-center">
        @if($image)
            <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-full object-cover">
        @else
            <svg class="w-24 h-24 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
            </svg>
        @endif
    </div>
    <div class="p-4">
        <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $name }}</h3>
        <p class="text-transparent bg-clip-text text-blue-600 font-semibold text-xl mb-3">
            Rp {{ $price }}
        </p>
        <x-atoms.button variant="primary" class="w-full">
            Pesan Sekarang
        </x-atoms.button>
    </div>
</div>
