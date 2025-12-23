@php
    $aboutSection = App\Models\CompanySection::getByType('about');
@endphp

@if($aboutSection)
<section id="company-profile" class="min-h-screen w-full flex items-center justify-center py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl w-full mx-auto">
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            class="grid md:grid-cols-2 gap-16 items-center"
        >
            {{-- Left Side: Text Content --}}
            <div class="space-y-8">
                {{-- Title --}}
                <div
                    :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'"
                    class="transition-all duration-1000 ease-out"
                >
                    <h2 class="text-4xl md:text-5xl font-extrabold text-amber-500 mb-4 transition-transform duration-300">
                        {{ $aboutSection->title }}
                    </h2>
                    @if($aboutSection->subtitle)
                        <p class="text-xl font-medium text-gray-100">{{ $aboutSection->subtitle }}</p>
                    @endif
                </div>

                {{-- Text Content --}}
                <div class="space-y-6">
                    @foreach($aboutSection->content_blocks ?? [] as $index => $block)
                        <div
                            :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'"
                            class="flex items-start space-x-4 transition-all duration-1000 ease-out stagger-{{ $index + 1 }} rounded-xl p-4"
                        >
                            <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">{{ $block['title'] }}</h3>
                                <p class="text-gray-50 leading-relaxed text-lg">
                                    {{ $block['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Side: Images (Grid or Slider) --}}
            <div
                :class="visible ? 'opacity-100 translate-x-0 scale-100' : 'opacity-0 translate-x-12 scale-95'"
                class="transition-all duration-1200 ease-out delay-300"
            >
                @php
                    $layout = $aboutSection->image_layout ?? 'slider';
                    $images = $aboutSection->images ?? [];
                @endphp

                @if(count($images) > 0)
                    @if($layout === 'slider')
                        <div class="hover-glow rounded-2xl overflow-hidden">
                            <x-molecules.image-slider
                                :images="collect($images)->map(fn($img) => [
                                    'src' => asset('storage/' . $img['path']),
                                    'alt' => $img['alt'] ?? 'Company Image',
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
                                        alt="{{ $img['alt'] ?? 'Company Image' }}"
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
                                'src' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?w=800',
                                'alt' => 'Tropical Fish Collection',
                                'title' => 'Premium Tropical Fish',
                                'description' => 'High-quality ornamental fish'
                            ],
                            [
                                'src' => 'https://images.unsplash.com/photo-1520990623178-dc3a6b1dd137?w=800',
                                'alt' => 'Aquarium Facility',
                                'title' => 'Modern Facilities',
                                'description' => 'State-of-the-art aquarium systems'
                            ]
                        ]"
                        :interval="3000"
                        aspect-ratio="aspect-[3/3]"
                    />
                @endif
            </div>
        </div>
    </div>
</section>
@endif
