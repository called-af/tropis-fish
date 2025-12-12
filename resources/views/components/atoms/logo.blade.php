@props(['size' => 'md'])

@php
$sizes = [
    'sm' => 'h-6',
    'md' => 'h-8',
    'lg' => 'h-12',
];
@endphp

<img src="{{ asset('images/logo.png') }}" alt="PT. Tropis Fish Indonesia" class="{{ $sizes[$size] }} {{ $attributes->get('class') }}" />
