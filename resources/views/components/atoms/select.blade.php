@props([
    'label' => null,
    'error' => null,
    'variant' => 'outline',
    'options' => [],
    'placeholder' => null,
])

@php
$variants = [
    'outline' => 'border border-amber-500/50 text-amber-400 bg-transparent focus:bg-amber-500/10 focus:border-amber-500 font-light tracking-wide',
    'filled' => 'bg-transparent border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
];

$classes = $variants[$variant] . ' w-full px-4 py-3 transition-all duration-300 focus:outline-none appearance-none cursor-pointer';
@endphp

<div class="w-full">
    @if($label)
        <label class="block text-sm font-semibold text-amber-400 mb-2">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <select
            {{ $attributes->merge(['class' => $classes]) }}
        >
            @if($placeholder)
                <option value="" class="text-amber-400/60">{{ $placeholder }}</option>
            @endif

            @if(!empty($options))
                @foreach($options as $value => $label)
                    <option value="{{ $value }}" class="bg-gray-900 text-white">{{ $label }}</option>
                @endforeach
            @else
                {{ $slot }}
            @endif
        </select>

        {{-- Custom Arrow Icon --}}
        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>

    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>