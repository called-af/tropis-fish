@props(['icon', 'title', 'value'])

<div class="flex items-start gap-4 group">
    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
        <x-atoms.icon :name="$icon" class="text-black" />
    </div>
    <div>
        <h3 class="font-bold text-amber-500 mb-1">{{ $title }}</h3>
        <p class="text-gray-300">{{ $value }}</p>
    </div>
</div>
