@props([
    'type' => 'text',
    'label' => null,
    'error' => null,
    'variant' => 'outline',
])

@php
$variants = [
    'outline' => 'border border-amber-500/50 text-amber-500 bg-transparent placeholder:text-amber-500/60 focus:bg-amber-500/10 focus:border-amber-500 font-light tracking-wide',
    'filled' => 'bg-transparent border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
];

$classes = $variants[$variant] . ' w-full px-4 py-3 transition-all duration-300 focus:outline-none';
@endphp

<div class="w-full">
    @if($label)
        <label class="block text-sm font-semibold text-amber-500 mb-2">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        {{ $attributes->merge(['class' => $classes]) }}
    >

    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
