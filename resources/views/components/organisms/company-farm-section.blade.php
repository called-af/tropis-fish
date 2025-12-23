@php
    $farmSection = App\Models\CompanySection::getByType('farm');
@endphp

@if($farmSection)
    <section class="py-20 w-full" x-data="{ visible: false }" x-intersect:enter="visible = true"
        x-intersect:leave="visible = false">
        <div class="container w-full mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                {{-- Left Side: Images (Grid or Slider) --}}
                <div :class="visible ? 'opacity-100 translate-x-0 scale-100' : 'opacity-0 -translate-x-16 scale-90'"
                    class="order-2 md:order-1 transition-all duration-1200 ease-out">
                    @php
                        $layout = $farmSection->image_layout ?? 'slider';
                        $images = $farmSection->images ?? [];
                    @endphp

                    @if(count($images) > 0)
                        @if($layout === 'slider')
                            <div class="hover-glow rounded-2xl overflow-hidden">
                                <x-molecules.image-slider :images="collect($images)->map(fn($img) => [
                                'src' => asset('storage/' . $img['path']),
                                'alt' => $img['alt'] ?? 'Farm Image',
                                'title' => '',
                                'description' => ''
                            ])->toArray()" :interval="3000" aspect-ratio="aspect-[3/3]" />
                            </div>
                        @else
                            {{-- Grid Layout --}}
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($images as $index => $img)
                                    <div
                                        class="{{ $index === 0 ? 'col-span-2' : '' }} aspect-{{ $index === 0 ? 'video' : 'square' }} overflow-hidden rounded-xl relative group">
                                        <img src="{{ asset('storage/' . $img['path']) }}" alt="{{ $img['alt'] ?? 'Farm Image' }}"
                                            class="w-full h-full object-cover transform transition-all duration-700" />
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 transition-opacity duration-500">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                            {{-- Default Slider --}}
                            <x-molecules.image-slider :images="[
                            [
                                'src' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?w=800',
                                'alt' => 'Fish Farm Main Facility',
                                'title' => 'Main Facility',
                                'description' => 'State-of-the-art fish farm'
                            ],
                            [
                                'src' => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=600',
                                'alt' => 'Aquarium Tanks',
                                'title' => 'Aquarium Systems',
                                'description' => 'Modern tank infrastructure'
                            ]
                        ]" :interval="3000"
                                aspect-ratio="aspect-[3/3]" />
                    @endif
                    {{-- Gallery Button --}}
                    <div :class="visible ? 'opacity-100 translate-y-0 scale-100' : 'opacity-0 translate-y-8 scale-90'"
                        class="pt-6 transition-all duration-1000 ease-out delay-500">
                        <a href="{{ route('gallery.farm') }}">
                            <x-atoms.button variant="outline" size="lg" class="hover-lift">
                                <div class="flex items-center gap-3">
                                    <x-heroicon-o-photo class="w-6 h-6" />
                                    <span>View Our Farm Gallery</span>
                                    <x-heroicon-o-arrow-right class="w-5 h-5 transition-transform duration-300" />
                                </div>
                            </x-atoms.button>
                        </a>
                    </div>
                </div>

                {{-- Right Side: Text Content (Reversed for zig-zag) --}}
                <div class="space-y-8 order-1 md:order-2">
                    {{-- Title --}}
                    <div :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'"
                        class="transition-all duration-1000 ease-out">
                        <h2 class="text-4xl md:text-5xl font-bold text-amber-500 mb-4 transition-transform duration-300">
                            {{ $farmSection->title }}
                        </h2>
                        @if($farmSection->subtitle)
                            <p class="text-xl text-gray-300">{{ $farmSection->subtitle }}</p>
                        @endif
                    </div>

                    {{-- Text Content --}}
                    <div class="space-y-6">
                        @foreach($farmSection->content_blocks ?? [] as $index => $block)
                            <div :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'"
                                class="flex items-start space-x-4 transition-all duration-1000 ease-out stagger-{{ $index + 1 }} rounded-xl p-4">
                                <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">{{ $block['title'] }}</h3>
                                    <p class="text-gray-300 leading-relaxed text-lg">
                                        {{ $block['description'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif