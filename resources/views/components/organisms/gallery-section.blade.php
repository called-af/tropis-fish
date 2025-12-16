@props(['galleries' => collect()])

<section id="gallery" class="py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
    <div class="max-w-6xl mx-auto">
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-1000 ease-out"
        >
            <x-molecules.section-header
                title="Fish Gallery"
                description="Explore our beautiful and diverse collection of tropical ornamental fish"
            />
        </div>

        @if($galleries->count() > 0)
            <div
                x-data="{ visible: false }"
                x-intersect:enter="visible = true"
                x-intersect:leave="visible = false"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out delay-200 grid grid-cols-2 md:grid-cols-4 gap-6"
            >
                @foreach($galleries as $index => $gallery)
                    <div class="group aspect-square bg-white/5 border border-white/10 hover:border-amber-500/50 overflow-hidden cursor-pointer relative transition-all duration-500">
                        <img
                            src="{{ asset("storage/{$gallery->image_path}") }}"
                            alt="{{ $gallery->title }}"
                            class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <div>
                                <p class="text-white font-semibold text-sm tracking-wide">{{ $gallery->title }}</p>
                                @if($gallery->category)
                                    <p class="text-amber-400 text-xs mt-1">{{ $gallery->category }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-16">
                <x-atoms.button variant="outline" href="{{ route('gallery') }}">
                    View All Gallery
                </x-atoms.button>
            </div>
        @else
            <div
                x-data="{ visible: false }"
                x-intersect:enter="visible = true"
                x-intersect:leave="visible = false"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out delay-200 text-center py-16"
            >
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 mx-auto mb-6 bg-white/5 rounded-full flex items-center justify-center">
                        <x-heroicon-o-photo class="w-10 h-10 text-gray-500" />
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Gallery Coming Soon</h3>
                    <p class="text-gray-400">We're preparing our beautiful fish collection for you.</p>
                </div>
            </div>
        @endif
    </div>
</section>
