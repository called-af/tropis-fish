@props(['aboutSection' => null])

@if($aboutSection)
<section id="about" class="relative py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
    {{-- Wave Top --}}
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none">
        <svg class="relative block w-full h-20 md:h-28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <defs>
                <linearGradient id="waveGradient" x1="100%" y1="0%" x2="0%" y2="0%">
                    <stop offset="0%" style="stop-color:#f59e0b;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#fbbf24;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#d97706;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="url(#waveGradient)"></path>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto relative pt-20 z-10">
        {{-- Main About Section with Photo Left, Text Right --}}
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-1000 ease-out grid lg:grid-cols-2 gap-12 items-center mb-20"
        >
            {{-- Left: Photo --}}
            <div class="relative group">
                <div class="relative overflow-hidden rounded-t-4xl">
                    <img
                        src="{{ asset("storage/{$aboutSection->image_path}") }}"
                        alt="{{ $aboutSection->title }}"
                        class="w-full h-[550px] object-cover"
                    >
                </div>
            </div>

            {{-- Right: About Text --}}
            <div class="space-y-6">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                        {{ $aboutSection->title }}
                    </h2>
                </div>

                <p class="text-lg text-white leading-relaxed">
                    {!! $aboutSection->description_1 !!}
                </p>

                @if($aboutSection->description_2)
                    <p class="text-lg text-white leading-relaxed">
                        {{ $aboutSection->description_2 }}
                    </p>
                @endif

                <div class="grid sm:grid-cols-2 gap-6 pt-4">
                    @if($aboutSection->feature_1_title)
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                    <x-dynamic-component :component="'heroicon-o-'.$aboutSection->feature_1_icon" class="w-6 h-6 text-amber-500" />
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold mb-1">{{ $aboutSection->feature_1_title }}</h3>
                                <p class="text-white text-sm">{{ $aboutSection->feature_1_description }}</p>
                            </div>
                        </div>
                    @endif

                    @if($aboutSection->feature_2_title)
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                    <x-dynamic-component :component="'heroicon-o-'.$aboutSection->feature_2_icon" class="w-6 h-6 text-amber-500" />
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold mb-1">{{ $aboutSection->feature_2_title }}</h3>
                                <p class="text-white text-sm">{{ $aboutSection->feature_2_description }}</p>
                            </div>
                        </div>
                    @endif

                    @if($aboutSection->feature_3_title)
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                    <x-dynamic-component :component="'heroicon-o-'.$aboutSection->feature_3_icon" class="w-6 h-6 text-amber-500" />
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold mb-1">{{ $aboutSection->feature_3_title }}</h3>
                                <p class="text-white text-sm">{{ $aboutSection->feature_3_description }}</p>
                            </div>
                        </div>
                    @endif

                    @if($aboutSection->feature_4_title)
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                    <x-dynamic-component :component="'heroicon-o-'.$aboutSection->feature_4_icon" class="w-6 h-6 text-amber-500" />
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold mb-1">{{ $aboutSection->feature_4_title }}</h3>
                                <p class="text-white text-sm">{{ $aboutSection->feature_4_description }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
