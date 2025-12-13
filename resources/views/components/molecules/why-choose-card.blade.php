@props([
    'icon',
    'title',
    'description',
])

<div class="group p-8 bg-white/5 border border-white/10 hover:border-amber-500/30 transition-all duration-500">
    <div class="flex items-start gap-6">
        <div class="flex-shrink-0">
            <div class="w-12 h-12 border border-amber-500/50 flex items-center justify-center group-hover:bg-amber-500/10 transition-all duration-300">
                @php
                    $iconMap = [
                        'check' => 'heroicon-o-check',
                        'user-group' => 'heroicon-o-user-group',
                        'globe' => 'heroicon-o-globe-asia-australia',
                        'shield' => 'heroicon-o-shield-check',
                    ];
                    $iconComponent = $iconMap[$icon] ?? 'heroicon-o-check';
                @endphp
                <x-dynamic-component :component="$iconComponent" class="w-6 h-6 text-amber-500" />
            </div>
        </div>
        <div>
            <h3 class="text-xl font-light text-white mb-3 tracking-wide">{{ $title }}</h3>
            <p class="text-gray-400 font-light leading-relaxed">
                {{ $description }}
            </p>
        </div>
    </div>
</div>
