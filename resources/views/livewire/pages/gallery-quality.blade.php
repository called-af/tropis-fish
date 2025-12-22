<div class="min-h-screen bg-gradient-to-b bg-blue-950">
    <x-organisms.navbar />

    {{-- Page Header --}}
    <section class="pt-32 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-black/50 to-transparent">
        <div class="max-w-6xl mx-auto">
            <div x-data="{ visible: false }" x-intersect:enter="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out text-center">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">
                    <span class="text-amber-500">Quality</span> Gallery
                </h1>
                <p class="text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto">
                    See our rigorous quality control processes and standards in action
                </p>
            </div>
        </div>
    </section>

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Quality Control Gallery Section --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            @if($galleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($galleries as $index => $gallery)
                        <div
                            x-data="{ visible: false }"
                            x-intersect:enter="visible = true"
                            x-intersect:leave="visible = false"
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="transition-all duration-700 ease-out"
                            style="transition-delay: {{ $index * 50 }}ms"
                        >
                            <div class="group aspect-square bg-white/5 border border-white/10 hover:border-amber-500/50 overflow-hidden cursor-pointer relative transition-all duration-500 rounded-xl">
                                <img
                                    src="{{ asset('storage/' . $gallery->image_path) }}"
                                    alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
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
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-20 h-20 mx-auto mb-6 bg-white/5 rounded-full flex items-center justify-center">
                            <x-heroicon-o-shield-check class="w-10 h-10 text-gray-500" />
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">No Quality Control Gallery Yet</h3>
                        <p class="text-gray-400">We're preparing images of our quality control processes for you.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <x-organisms.footer />

    {{-- Terms Modal --}}
    <x-organisms.terms-modal />
</div>
