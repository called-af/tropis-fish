<section x-data="{
    currentSlide: 0,
    slides: [
        {
            title: 'Menciptakan Ikan Bahagia',
            subtitle: 'Kualitas Terbaik untuk Akuarium Anda',
            description: 'Lebih dari 500 varietas ikan hias tropis dengan kualitas breeding terjamin',
            cta: 'Lihat Koleksi'
        },
        {
            title: 'Pengiriman ke Seluruh Indonesia',
            subtitle: 'Aman & Terpercaya',
            description: 'Sistem packaging profesional untuk menjaga kesehatan ikan selama perjalanan',
            cta: 'Hubungi Kami'
        },
        {
            title: 'Mari Bicara Tentang Ikan',
            subtitle: 'Konsultasi Gratis',
            description: 'Tim ahli kami siap membantu Anda memilih ikan yang tepat',
            cta: 'Chat Sekarang'
        }
    ],
    init() {
        setInterval(() => {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length
        }, 5000)
    }
}" class="relative h-[600px] md:h-[700px] overflow-hidden">

    {{-- Video Background --}}
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('videos/aquarium.mp4') }}" type="video/mp4">
    </video>

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-blue-800/85 to-orange-800/90"></div>

    {{-- Slides --}}
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
                    <p class="text-2xl md:text-3xl text-orange-300 font-semibold mb-4" x-text="slide.subtitle"></p>
                    <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl" x-text="slide.description"></p>

                    <div class="flex flex-wrap gap-4">
                        <x-atoms.button variant="secondary" size="lg" href="#produk">
                            <span x-text="slide.cta"></span>
                        </x-atoms.button>
                        <x-atoms.button variant="outline" size="lg" href="#kontak" class="!text-white !border-white hover:!bg-white/10">
                            Pelajari Lebih Lanjut
                        </x-atoms.button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- Slide Indicators --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex gap-3 z-10">
        <template x-for="(slide, index) in slides" :key="index">
            <button
                @click="currentSlide = index"
                :class="currentSlide === index ? 'bg-orange-500 w-12' : 'bg-white/50 w-3'"
                class="h-3 rounded-full transition-all duration-300 hover:bg-orange-400"
            ></button>
        </template>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>
