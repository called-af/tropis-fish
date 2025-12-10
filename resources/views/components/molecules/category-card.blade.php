@props(['name', 'count', 'image' => null])

<div class="group relative overflow-hidden rounded-2xl aspect-square cursor-pointer">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-orange-600"></div>

    @if($image)
        <img src="{{ $image }}" alt="{{ $name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
    @else
        <div class="absolute inset-0 flex items-center justify-center">
            <svg class="w-32 h-32 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
            </svg>
        </div>
    @endif

    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
        <h3 class="text-2xl font-bold mb-1">{{ $name }}</h3>
        <p class="text-white/90">{{ $count }} Jenis Ikan</p>
    </div>
</div>
