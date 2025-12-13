@props(['icon', 'title', 'description'])

<div class="p-6 bg-gradient-to-br from-blue-50 to-amber-50 rounded-2xl border border-gray-200">
    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-amber-600 rounded-xl flex items-center justify-center mb-4">
        <x-atoms.icon :name="$icon" class="text-white" />
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $title }}</h3>
    <p class="text-gray-600">{{ $description }}</p>
</div>
