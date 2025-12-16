@props([
    'placeholder' => 'Search...',
])

<div class="relative w-full">
    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
        <x-heroicon-o-magnifying-glass class="w-5 h-5 text-amber-400" />
    </div>
    <input
        type="text"
        {{ $attributes->merge(['class' => 'w-full pl-12 pr-4 py-3 bg-transparent border border-amber-500/50 text-amber-400 placeholder:text-amber-400/60 rounded-lg focus:bg-amber-500/10 focus:border-amber-500 transition focus:outline-none font-light tracking-wide']) }}
        placeholder="{{ $placeholder }}"
    >
</div>
