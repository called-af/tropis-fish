@php
    $qualitySection = App\Models\CompanySection::getByType('quality');
@endphp

@if($qualitySection)
<section class="py-20">
    <div class="container mx-auto px-6">
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-1000 ease-out grid md:grid-cols-2 gap-16 items-center"
        >
            {{-- Left Side: Text Content --}}
            <div class="space-y-8">
                {{-- Title --}}
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-amber-500 mb-4">{{ $qualitySection->title }}</h2>
                    @if($qualitySection->subtitle)
                        <p class="text-xl text-gray-300">{{ $qualitySection->subtitle }}</p>
                    @endif
                </div>

                {{-- Text Content --}}
                <div class="space-y-6">
                    @foreach($qualitySection->content_blocks ?? [] as $block)
                        <div class="flex items-start space-x-4">
                            <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0"></div>
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
                            <h4 class="text-xl font-bold text-white mb-4">Our Process</h4>
                            @foreach($qualitySection->process_steps as $step)
                                <div class="flex items-start space-x-4">
                                    <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">{{ $step['number'] }}</div>
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
            <div class="space-y-6">
                @php
                    $layout = $qualitySection->image_layout ?? 'slider';
                    $images = $qualitySection->images ?? [];
                @endphp

                @if(count($images) > 0)
                    @if($layout === 'slider')
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
                    @else
                        {{-- Grid Layout --}}
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($images as $index => $img)
                                <div class="{{ $index === 0 ? 'col-span-2' : '' }} aspect-{{ $index === 0 ? 'video' : 'square' }} overflow-hidden rounded-xl relative group">
                                    <img
                                        src="{{ asset('storage/' . $img['path']) }}"
                                        alt="{{ $img['alt'] ?? 'Quality Control Image' }}"
                                        class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110"
                                    />
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
                    <a href="{{ route('gallery') }}">
                        <x-atoms.button
                            variant="outline"
                            size="lg"
                        >
                            <div class="flex items-center gap-3">
                                <x-heroicon-o-video-camera class="w-6 h-6" />
                                <span>View Our Quality Footage</span>
                                <x-heroicon-o-arrow-right class="w-5 h-5" />
                            </div>
                        </x-atoms.button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
