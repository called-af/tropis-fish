@props([
    'title',
    'description' => null,
])

<div class="text-center mb-20">
    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">
        {{ $title }}
    </h2>
    <div class="w-20 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mb-6"></div>
    @if($description)
        <p class="text-lg text-gray-100 font-lg max-w-2xl mx-auto">
            {{ $description }}
        </p>
    @endif
</div>
