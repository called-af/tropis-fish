@props([
    'type' => 'text',
    'label' => null,
    'error' => null,
])

<div class="w-full">
    @if($label)
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        {{ $attributes->merge(['class' => 'w-full px-4 py-3 rounded-lg ring-1 ring-gray-300 focus:ring-2 focus:ring-blue-500 bg-white transition']) }}
    >

    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
