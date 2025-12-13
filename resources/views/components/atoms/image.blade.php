@props([
    'src',
    'alt' => '',
    'class' => '',
    'loading' => 'lazy',
    'objectFit' => 'cover'
])

<img
    src="{{ $src }}"
    alt="{{ $alt }}"
    loading="{{ $loading }}"
    {{ $attributes->merge(['class' => "w-full h-full object-{$objectFit} {$class}"]) }}
/>
