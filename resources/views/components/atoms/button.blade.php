@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'loadingIcon' => 'arrow-path',
])

@php
$variants = [
    'primary' => 'bg-blue-600 hover:bg-blue-700 text-white shadow-lg shadow-blue-500/30',
    'secondary' => 'bg-amber-600 hover:bg-amber-700 text-white shadow-lg shadow-amber-500/30',
    'outline' => 'border border-amber-500/50 text-amber-500 hover:bg-amber-500/10 hover:border-amber-500 font-light tracking-wide',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white shadow-lg shadow-red-500/30',
];

$sizes = [
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-8 py-3 text-base',
    'lg' => 'px-10 py-4 text-lg',
];

$iconSizes = [
    'sm' => 'w-4 h-4',
    'md' => 'w-5 h-5',
    'lg' => 'w-6 h-6',
];

$classes = $variants[$variant] . ' ' . $sizes[$size] . ' inline-flex items-center justify-center gap-2 transition-all duration-300';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes . ' font-semibold rounded-full transition inline-block']) }}>
        @if($icon && $iconPosition === 'left')
            <x-dynamic-component :component="'heroicon-o-' . $icon" :class="$iconSizes[$size]" />
        @endif
        <span>{{ $slot }}</span>
        @if($icon && $iconPosition === 'right')
            <x-dynamic-component :component="'heroicon-o-' . $icon" :class="$iconSizes[$size]" />
        @endif
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes . ' font-semibold rounded-full transition']) }}>
        @if($icon && $iconPosition === 'left')
            <x-dynamic-component :component="'heroicon-o-' . $icon" :class="$iconSizes[$size]" wire:loading.remove />
            <x-dynamic-component :component="'heroicon-o-' . $loadingIcon" :class="$iconSizes[$size] . ' animate-spin'" wire:loading />
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'right')
            <x-dynamic-component :component="'heroicon-o-' . $icon" :class="$iconSizes[$size]" wire:loading.remove />
            <x-dynamic-component :component="'heroicon-o-' . $loadingIcon" :class="$iconSizes[$size] . ' animate-spin'" wire:loading />
        @endif
    </button>
@endif
