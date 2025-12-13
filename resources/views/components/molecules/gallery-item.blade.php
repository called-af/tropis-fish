@props([
    'index' => 1,
])

<div class="group aspect-square bg-white/5 border border-white/10 hover:border-amber-500/50 overflow-hidden cursor-pointer relative transition-all duration-500">
    <div class="w-full h-full flex items-center justify-center transition-all duration-500 group-hover:scale-110">
        <x-heroicon-o-photo class="w-16 h-16 text-gray-600 group-hover:text-amber-500 transition-colors duration-300" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
        <p class="text-white font-light text-sm tracking-wide">Ornamental Fish #{{ $index }}</p>
    </div>
</div>
