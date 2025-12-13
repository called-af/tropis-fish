@props([
    'icon' => null,
    'title',
    'description'
])

<div {{ $attributes->merge(['class' => 'bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:border-blue-400/50 transition-all duration-300 hover:transform hover:scale-105']) }}>
    @if($icon)
        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/50">
            {!! $icon !!}
        </div>
    @endif

    <h3 class="text-2xl font-bold text-white mb-4">{{ $title }}</h3>
    <p class="text-gray-200 leading-relaxed">{{ $description }}</p>
</div>
