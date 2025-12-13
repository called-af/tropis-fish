@props(['icon', 'title', 'value'])

<div class="flex items-start gap-4">
    <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-amber-100 rounded-xl flex items-center justify-center shrink-0">
        <x-atoms.icon :name="$icon" class="text-blue-600" />
    </div>
    <div>
        <h3 class="font-bold text-gray-900 mb-1">{{ $title }}</h3>
        <p class="text-gray-600">{{ $value }}</p>
    </div>
</div>
