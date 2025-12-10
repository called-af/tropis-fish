@props(['href', 'active' => false])

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => 'text-gray-900 hover:text-blue-600 transition font-medium']) }}
>
    {{ $slot }}
</a>
