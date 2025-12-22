@php
    $qualitySection = App\Models\CompanySection::getByType('quality');
@endphp

@if($qualitySection)
<section class="py-20" x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            {{-- Left Side: Text Content --}}
            <div class="space-y-8">
                {{-- Title --}}
                <div
                    :class="visible ? 'opacity-100 translate-x-0 scale-100' : 'opacity-0 -translate-x-12 scale-95'"
                    class="transition-all duration-1000 ease-out"
                >
                    <h2 class="text-4xl md:text-5xl font-bold text-amber-500 mb-4 transition-transform duration-300">
                        {{ $qualitySection->title }}
                    </h2>
                    @if($qualitySection->subtitle)
                        <p class="text-xl text-gray-300">{{ $qualitySection->subtitle }}</p>
                    @endif
                </div>

                {{-- Text Content --}}
                <div class="space-y-6">
                    @foreach($qualitySection->content_blocks ?? [] as $index => $block)
                        <div
                            :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'"
                            class="flex items-start space-x-4 transition-all duration-1000 ease-out stagger-{{ $index + 1 }} rounded-xl p-4"
                        >
                            <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">{{ $block['title'] }}</h3>
                                <p class="text-gray-300 leading-relaxed text-lg">
                                    {{ $block['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                    {{-- Quality Process Steps --}}
                    @if($qualitySection->process_steps && count($qualitySection->process_steps) > 0)
                        <div class="space-y-3 pt-4">
                            <h4
                                :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'"
                                class="text-xl font-bold text-white mb-4 transition-all duration-1000 ease-out delay-300"
                            >
                                Our Process
                            </h4>
                            @foreach($qualitySection->process_steps as $index => $step)
                                <div
                                    :class="visible ? 'opacity-100 translate-x-0 rotate-0' : 'opacity-0 -translate-x-8 rotate-2'"
                                    class="flex items-start space-x-4 transition-all duration-1000 ease-out stagger-{{ $index + 4 }} rounded-xl p-3"
                                >
                                    <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 transition-transform duration-300 animate-pulse">
                                        {{ $step['number'] }}
                                    </div>
                                    <div class="text-white pt-1">
                                        <div class="font-semibold">{{ $step['title'] }}</div>
                                        <div class="text-sm text-gray-400">{{ $step['description'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Side: Images (Grid or Slider) --}}
            <div
                :class="visible ? 'opacity-100 translate-x-0 scale-100' : 'opacity-0 translate-x-16 scale-90'"
                class="space-y-6 transition-all duration-1200 ease-out delay-300"
            >
                @php
                    $layout = $qualitySection->image_layout ?? 'slider';
                    $images = $qualitySection->images ?? [];
                @endphp

                @if(count($images) > 0)
                    @if($layout === 'slider')
                        <div class="hover-glow rounded-2xl overflow-hidden">
                            <x-molecules.image-slider
                                :images="collect($images)->map(fn($img) => [
                                    'src' => asset('storage/' . $img['path']),
                                    'alt' => $img['alt'] ?? 'Quality Control Image',
                                    'title' => '',
                                    'description' => ''
                                ])->toArray()"
                                :interval="3000"
                                aspect-ratio="aspect-[3/3]"
                            />
                        </div>
                    @else
                        {{-- Grid Layout --}}
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($images as $index => $img)
                                <div class="{{ $index === 0 ? 'col-span-2' : '' }} aspect-{{ $index === 0 ? 'video' : 'square' }} overflow-hidden rounded-xl relative group">
                                    <img
                                        src="{{ asset('storage/' . $img['path']) }}"
                                        alt="{{ $img['alt'] ?? 'Quality Control Image' }}"
                                        class="w-full h-full object-cover transform transition-all duration-700"
                                    />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 transition-opacity duration-500"></div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    {{-- Default Slider --}}
                    <x-molecules.image-slider
                        :images="[
                            [
                                'src' => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=800',
                                'alt' => 'Quality Control Room',
                                'title' => 'Quality Control',
                                'description' => 'Professional inspection process'
                            ],
                            [
                                'src' => 'https://images.unsplash.com/photo-1520990623178-dc3a6b1dd137?w=800',
                                'alt' => 'Quarantine Area',
                                'title' => 'Quarantine Facilities',
                                'description' => 'Special care before shipment'
                            ]
                        ]"
                        :interval="3000"
                        aspect-ratio="aspect-[3/3]"
                    />
                @endif

                {{-- Quality Footage Button --}}
                <div class="pt-4">
                    <a href="{{ route('gallery.quality') }}">
                        <x-atoms.button
                            variant="outline"
                            size="lg"
                            class="hover-lift group"
                        >
                            <div class="flex items-center gap-3">
                                <x-heroicon-o-video-camera class="w-6 h-6" />
                                <span>View Our Quality Footage</span>
                                <x-heroicon-o-arrow-right class="w-5 h-5 transition-transform duration-300" />
                            </div>
                        </x-atoms.button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
