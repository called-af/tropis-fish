@props(['heroes' => []])

<section x-data="{
    currentSlide: 0,
    youtubePlayers: {},
    slides: {{ json_encode($heroes->map(fn($hero) => [
        'id' => $hero->id,
        'title' => $hero->title,
        'description' => $hero->description,
        'backgroundType' => $hero->background_type,
        'image' => $hero->image_path ? asset('storage/' . $hero->image_path) : null,
        'video' => $hero->video_path ? asset('storage/' . $hero->video_path) : null,
        'youtube' => $hero->youtube_url
    ])) }},
    getYouTubeId(url) {
        if (!url) {
            return null;
        }
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    },
    initYouTubePlayer(index) {
        const slide = this.slides[index];
        if (slide.backgroundType !== 'youtube' || !slide.youtube) {
            return;
        }

        const videoId = this.getYouTubeId(slide.youtube);
        if (!videoId) {
            return;
        }

        const iframeId = 'youtube-player-' + index;
        const iframe = document.getElementById(iframeId);
        if (!iframe) {
            return;
        }

        // Reset iframe src to force reload with high quality
        const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1&loop=1&playlist=${videoId}&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1&enablejsapi=1&vq=hd1080&quality=highres`;
        iframe.src = embedUrl;
    },
    restartVideo(index) {
        const slide = this.slides[index];
        const videoId = 'video-player-' + index;
        const videoEl = document.getElementById(videoId);

        if (videoEl && slide.backgroundType === 'video') {
            videoEl.currentTime = 0;
            videoEl.play().catch(() => {});
        }
    },
    changeSlide(newIndex) {
        this.currentSlide = newIndex;

        // Delay untuk memberi waktu transisi
        setTimeout(() => {
            const slide = this.slides[newIndex];
            if (slide.backgroundType === 'youtube') {
                this.initYouTubePlayer(newIndex);
            } else if (slide.backgroundType === 'video') {
                this.restartVideo(newIndex);
            }
        }, 100);
    },
    init() {
        // Auto-advance slides
        if (this.slides.length > 1) {
            setInterval(() => {
                this.changeSlide((this.currentSlide + 1) % this.slides.length);
            }, 8000);
        }

        // Initialize first slide
        this.$nextTick(() => {
            const firstSlide = this.slides[0];
            if (firstSlide.backgroundType === 'youtube') {
                this.initYouTubePlayer(0);
            } else if (firstSlide.backgroundType === 'video') {
                this.restartVideo(0);
            }
        });
    }
}" class="relative h-screen w-full overflow-hidden">

    @if($heroes && $heroes->count() > 0)
        {{-- Background Media Layers --}}
        <template x-for="(slide, index) in slides" :key="'slide-' + index">
            <div
                x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 h-screen"
            >
                {{-- YouTube Video --}}
                <template x-if="slide.backgroundType === 'youtube' && slide.youtube">
                    <div class="absolute inset-0 w-full h-screen overflow-hidden bg-black">
                        <iframe
                            :id="'youtube-player-' + index"
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"
                            style="width: 177.77777778vh; height: 56.25vw; min-height: 100vh; min-width: 100vw;"
                            frameborder="0"
                            allow="autoplay; encrypted-media; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </div>
                </template>

                {{-- Local Video --}}
                <template x-if="slide.backgroundType === 'video' && slide.video">
                    <video
                        :id="'video-player-' + index"
                        autoplay
                        muted
                        loop
                        playsinline
                        preload="metadata"
                        class="absolute inset-0 w-full h-screen object-cover"
                    >
                        <source :src="slide.video" type="video/mp4">
                    </video>
                </template>

                {{-- Image --}}
                <template x-if="slide.backgroundType === 'image' && slide.image">
                    <img
                        :src="slide.image"
                        :alt="slide.title"
                        loading="lazy"
                        class="absolute inset-0 w-full h-screen object-cover"
                    >
                </template>
            </div>
        </template>

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 h-screen bg-gradient-to-b from-black/90 via-blue-950/50 to-blue-900/45 pointer-events-none"></div>

        {{-- Slides Content --}}
        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
            <template x-for="(slide, index) in slides" :key="index">
                <div
                    x-show="currentSlide === index"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute inset-0 flex items-center px-4 sm:px-6 lg:px-8"
                >
                    <div class="max-w-3xl space-y-4 sm:space-y-6 w-full">
                        <h1
                            class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-tight break-words"
                            x-text="slide.title"
                            x-transition:enter="transition ease-out duration-1000 delay-200"
                            x-transition:enter-start="opacity-0 translate-x-[-50px]"
                            x-transition:enter-end="opacity-100 translate-x-0"
                        ></h1>

                        <p
                            class="text-sm sm:text-base md:text-lg lg:text-xl text-white/90 max-w-2xl break-words"
                            x-text="slide.description"
                            x-transition:enter="transition ease-out duration-1000 delay-400"
                            x-transition:enter-start="opacity-0 translate-x-[-30px]"
                            x-transition:enter-end="opacity-100 translate-x-0"
                        ></p>

                        <div
                            class="flex flex-col sm:flex-row gap-3 sm:gap-4"
                            x-transition:enter="transition ease-out duration-1000 delay-600"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                        >
                            <x-atoms.button variant="secondary" size="lg" href="#products" class="hover-lift w-full sm:w-auto justify-center">
                                View Collection
                            </x-atoms.button>
                            <x-atoms.button variant="outline" size="lg" href="#contact" class="hover-lift w-full sm:w-auto justify-center">
                                Contact Us
                            </x-atoms.button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Slide Indicators --}}
        @if($heroes->count() > 1)
            <div class="absolute bottom-6 sm:bottom-8 left-1/2 -translate-x-1/2 flex gap-2 sm:gap-3 z-10 px-4">
                <template x-for="(slide, index) in slides" :key="'indicator-' + index">
                    <button
                        @click="changeSlide(index)"
                        :class="currentSlide === index ? 'bg-amber-500 w-8 sm:w-12 scale-110' : 'bg-white/50 w-2 sm:w-3 scale-100'"
                        class="h-2 sm:h-3 rounded-full transition-all duration-500"
                        :aria-label="'Go to slide ' + (index + 1)"
                    ></button>
                </template>
            </div>
        @endif
    @else
        {{-- Fallback Hero --}}
        <div class="absolute inset-0 h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700"></div>

        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
            <div class="max-w-3xl px-4 sm:px-0">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-4 sm:mb-6 leading-tight break-words">Welcome to <span class="font-stencil">PT. TROPIS FISH INDONESIA</span></h1>
                    <p class="text-sm sm:text-base md:text-lg lg:text-xl text-white/90 mb-6 sm:mb-8 max-w-2xl break-words">Premium quality ornamental fish exporter with worldwide delivery</p>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <x-atoms.button variant="secondary" size="lg" href="#products" class="w-full sm:w-auto justify-center">
                            View Collection
                        </x-atoms.button>
                        <x-atoms.button variant="outline" size="lg" href="#contact" class="w-full sm:w-auto justify-center">
                            Contact Us
                        </x-atoms.button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
