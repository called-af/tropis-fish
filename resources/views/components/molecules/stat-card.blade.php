@props(['value', 'label'])

<div class="text-center p-6 transition-transform">
    <div class="text-4xl md:text-5xl font-bold text-gray-950 mb-2">
        {{ $value }}
    </div>
    <div class="text-gray-900 font-medium">
        {{ $label }}
    </div>
</div>
