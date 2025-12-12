@props(['name', 'size' => 'md'])

@php
$sizes = [
    'sm' => 'w-4 h-4',
    'md' => 'w-6 h-6',
    'lg' => 'w-8 h-8',
    'xl' => 'w-12 h-12',
];

$icons = [
    'check' => 'heroicon-o-check-circle',
    'money' => 'heroicon-o-currency-dollar',
    'lightning' => 'heroicon-o-bolt',
    'phone' => 'heroicon-o-phone',
    'mail' => 'heroicon-o-envelope',
    'location' => 'heroicon-o-map-pin',
    'clock' => 'heroicon-o-clock',
    'menu' => 'heroicon-o-bars-3',
    'close' => 'heroicon-o-x-mark',
];
@endphp

@php
    $iconComponent = $icons[$name] ?? 'heroicon-o-question-mark-circle';
@endphp

<x-dynamic-component :component="$iconComponent" class="{{ $sizes[$size] }} {{ $attributes->get('class') }}" {{ $attributes->except('class') }} />
