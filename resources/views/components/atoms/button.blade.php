@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
$variants = [
    'primary' => 'bg-blue-600 hover:bg-blue-700 text-white shadow-lg shadow-blue-500/30',
    'secondary' => 'bg-orange-600 hover:bg-orange-700 text-white shadow-lg shadow-orange-500/30',
    'outline' => 'bg-transparent hover:bg-gray-50 text-gray-900 border border-gray-200',
];

$sizes = [
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-8 py-3 text-base',
    'lg' => 'px-10 py-4 text-lg',
];

$classes = $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes . ' font-semibold rounded-full transition inline-block']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes . ' font-semibold rounded-full transition']) }}>
        {{ $slot }}
    </button>
@endif
