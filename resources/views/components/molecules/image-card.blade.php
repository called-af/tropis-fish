@props([
    'src',
    'alt' => '',
    'title' => null,
    'description' => null,
    'aspectRatio' => 'aspect-video'
])

<div {{ $attributes->merge(['class' => 'group relative overflow-hidden rounded-2xl bg-gray-900/50 backdrop-blur-sm']) }}>
    <div class="{{ $aspectRatio }} overflow-hidden">
        <x-atoms.image
            :src="$src"
            :alt="$alt"
            class="transform transition-transform duration-500 group-hover:scale-110"
        />
    </div>

    @if($title || $description)
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                @if($title)
                    <h3 class="text-xl font-bold mb-2">{{ $title }}</h3>
                @endif
                @if($description)
                    <p class="text-sm text-gray-200">{{ $description }}</p>
                @endif
            </div>
        </div>
    @endif
</div>
