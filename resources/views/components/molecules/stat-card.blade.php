@props(['value', 'label', 'suffix' => ''])

<div class="text-center p-6 transition-transform">
    <div class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">
        {{ $value }}{{ $suffix }}
    </div>
    <div class="text-gray-800 font-medium">
        {{ $label }}
    </div>
</div>
