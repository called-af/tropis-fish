@props(['heroes' => []])

<section x-data="{
    currentSlide: 0,
    slides: {{ json_encode($heroes->map(fn($hero) => [
        'title' => $hero->title,
        'description' => $hero->description,
        'image' => asset('storage/' . $hero->image_path),
        'video' => $hero->video_path ? asset('storage/' . $hero->video_path) : null,
        'youtube' => $hero->youtube_url
    ])) }},
    init() {
        if (this.slides.length > 1) {
            setInterval(() => {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length
            }, 5000)
        }
    }
}" class="relative h-screen overflow-hidden">

    @if($heroes && $heroes->count() > 0)
        {{-- Background (Video or Image) --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div
                x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
            >
                <template x-if="slide.youtube">
                    <iframe
                        :src="`${slide.youtube}?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1&enablejsapi=1`"
                        class="absolute inset-0 w-full h-full pointer-events-none"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        :key="`youtube-${index}`"
                        style="transform: scale(1.5);"
                    ></iframe>
                </template>
                <template x-if="!slide.youtube && slide.video">
                    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover" :key="`video-${index}`">
                        <source :src="slide.video" type="video/mp4">
                    </video>
                </template>
                <template x-if="!slide.youtube && !slide.video">
                    <img :src="slide.image" :alt="slide.title" class="absolute inset-0 w-full h-full object-cover">
                </template>
            </div>
        </template>

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-blue-950/70 to-blue-900/65"></div>

        {{-- Slides Content --}}
        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
            <template x-for="(slide, index) in slides" :key="index">
                <div
                    x-show="currentSlide === index"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-12"
                    class="absolute inset-0 flex items-center"
                >
                    <div class="max-w-3xl">
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight" x-text="slide.title"></h1>
                        <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl" x-text="slide.description"></p>

                        <div class="flex flex-wrap gap-4">
                            <x-atoms.button variant="secondary" size="lg" href="#products">
                                View Collection
                            </x-atoms.button>
                            <x-atoms.button variant="outline" size="lg" href="#contact">
                                Contact Us
                            </x-atoms.button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Slide Indicators --}}
        @if($heroes->count() > 1)
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex gap-3 z-10">
                <template x-for="(slide, index) in slides" :key="index">
                    <button
                        @click="currentSlide = index"
                        :class="currentSlide === index ? 'bg-amber-500 w-12' : 'bg-white/50 w-3'"
                        class="h-3 rounded-full transition-all duration-300 hover:bg-amber-400"
                    ></button>
                </template>
            </div>
        @endif
    @else
        {{-- Fallback Hero --}}
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700"></div>

        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
            <div class="max-w-3xl">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">Welcome to PT. Tropis Fish Indonesia</h1>
                <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl">Premium quality ornamental fish exporter with worldwide delivery</p>

                <div class="flex flex-wrap gap-4">
                    <x-atoms.button variant="secondary" size="lg" href="#products">
                        View Collection
                    </x-atoms.button>
                    <x-atoms.button variant="outline" size="lg" href="#contact">
                        Contact Us
                    </x-atoms.button>
                </div>
            </div>
        </div>
    @endif
</section>
