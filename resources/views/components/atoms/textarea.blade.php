@props([
    'label' => null,
    'error' => null,
    'variant' => 'outline',
    'rows' => 4,
])

@php
$variants = [
    'outline' => 'border border-amber-500/50 text-amber-400 bg-transparent placeholder:text-amber-400/60 focus:bg-amber-500/10 focus:border-amber-500 font-light tracking-wide',
    'filled' => 'bg-transparent border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
];

$classes = $variants[$variant] . ' w-full px-4 py-3 rounded-lg transition-all duration-300 focus:outline-none resize-none';
@endphp

<div class="w-full">
    @if($label)
        <label class="flex items-center gap-2 text-sm font-semibold text-amber-400 mb-2">
            <x-heroicon-o-chat-bubble-left-right class="w-4 h-4" />
            {{ $label }}
        </label>
    @endif

    <textarea
        rows="{{ $rows }}"
        {{ $attributes->merge(['class' => $classes]) }}
    ></textarea>

    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
