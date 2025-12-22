<div class="min-h-screen bg-gradient-to-b bg-blue-950">
    <x-organisms.navbar />

    {{-- Page Header --}}
    <section class="pt-32 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-black/50 to-transparent">
        <div class="max-w-6xl mx-auto">
            <div x-data="{ visible: false }" x-intersect:enter="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out text-center">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">
                    Our <span class="text-amber-500">Gallery</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto">
                    Explore our beautiful collection of ornamental fish, state-of-the-art facilities, and quality control processes
                </p>
            </div>
        </div>
    </section>

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Fish Gallery Section --}}
    <section id="fish" class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-amber-500 mb-4">Fish Gallery</h2>
                <p class="text-xl text-gray-100">Our Premium Fish Collection</p>
            </div>

            @if($fishGalleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($fishGalleries as $index => $gallery)
                        <div
                            x-data="{ visible: false }"
                            x-intersect:enter="visible = true"
                            x-intersect:leave="visible = false"
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="transition-all duration-700 ease-out"
                            style="transition-delay: {{ $index * 50 }}ms"
                        >
                            <div class="group aspect-square bg-white/5 border border-white/10 hover:border-amber-500/50 overflow-hidden cursor-pointer relative transition-all duration-500 ">
                                <img
                                    src="{{ asset('storage/' . $gallery->image_path) }}"
                                    alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                                >
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                    <div>
                                        <p class="text-white font-semibold text-base tracking-wide">{{ $gallery->title }}</p>
                                        @if($gallery->description)
                                            <p class="text-gray-100 text-xs mt-2">{{ Str::limit($gallery->description, 60) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-400">No fish gallery images yet.</p>
            @endif
        </div>
    </section>

    {{-- Farm Gallery Section --}}
    <section id="farm" class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-amber-500 mb-4">Farm Gallery</h2>
                <p class="text-xl text-gray-100">Our State-of-the-Art Facilities</p>
            </div>

            @if($farmGalleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($farmGalleries as $index => $gallery)
                        <div
                            x-data="{ visible: false }"
                            x-intersect:enter="visible = true"
                            x-intersect:leave="visible = false"
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="transition-all duration-700 ease-out"
                            style="transition-delay: {{ $index * 50 }}ms"
                        >
                            <div class="group aspect-square bg-white/5 border border-white/10 hover:border-amber-500/50 overflow-hidden cursor-pointer relative transition-all duration-500 ">
                                <img
                                    src="{{ asset('storage/' . $gallery->image_path) }}"
                                    alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                                >
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                    <div>
                                        <p class="text-white font-semibold text-base tracking-wide">{{ $gallery->title }}</p>
                                        @if($gallery->description)
                                            <p class="text-gray-100 text-xs mt-2">{{ Str::limit($gallery->description, 60) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-400">No farm gallery images yet.</p>
            @endif
        </div>
    </section>

    {{-- Quality Control Gallery Section --}}
    <section id="quality" class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-amber-500 mb-4">Quality Control</h2>
                <p class="text-xl text-gray-100">Our Rigorous Quality Standards</p>
            </div>

            @if($qualityGalleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($qualityGalleries as $index => $gallery)
                        <div
                            x-data="{ visible: false }"
                            x-intersect:enter="visible = true"
                            x-intersect:leave="visible = false"
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="transition-all duration-700 ease-out"
                            style="transition-delay: {{ $index * 50 }}ms"
                        >
                            <div class="group aspect-square bg-white/5 border border-white/10 hover:border-amber-500/50 overflow-hidden cursor-pointer relative transition-all duration-500 ">
                                <img
                                    src="{{ asset('storage/' . $gallery->image_path) }}"
                                    alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                                >
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                    <div>
                                        <p class="text-white font-semibold text-base tracking-wide">{{ $gallery->title }}</p>
                                        @if($gallery->description)
                                            <p class="text-gray-100 text-xs mt-2">{{ Str::limit($gallery->description, 60) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-400">No quality control gallery images yet.</p>
            @endif
        </div>
    </section>

    <x-organisms.footer />

    {{-- Terms Modal --}}
    <x-organisms.terms-modal />
</div>
