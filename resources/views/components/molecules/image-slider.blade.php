@props([
    'images' => [],
    'interval' => 3000, // 3 seconds default
    'aspectRatio' => 'aspect-video'
])

<div
    x-data="{
        currentIndex: 0,
        images: {{ json_encode($images) }},
        interval: {{ $interval }},
        intervalId: null,
        autoSlide() {
            if (this.images.length > 1) {
                this.intervalId = setInterval(() => {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                }, this.interval);
            }
        },
        init() {
            this.autoSlide();
            this.$watch('currentIndex', () => {});
        }
    }"
    x-init="init()"
    {{ $attributes->merge(['class' => "relative overflow-hidden {$aspectRatio}"]) }}
>
    {{-- Images --}}
    <template x-for="(image, index) in images" :key="index">
        <div
            x-show="currentIndex === index"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform -translate-x-full"
            class="absolute inset-0"
        >
            <img
                :src="image.src"
                :alt="image.alt"
                class="w-full h-full object-cover"
            />
            {{-- Image Caption --}}
            <template x-if="image.title || image.description">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                    <h3 x-show="image.title" class="text-xl font-bold text-white" x-text="image.title"></h3>
                    <p x-show="image.description" class="text-sm text-gray-300" x-text="image.description"></p>
                </div>
            </template>
        </div>
    </template>

    {{-- Dots Indicator --}}
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
        <template x-for="(image, index) in images" :key="index">
            <button
                @click="currentIndex = index"
                :class="currentIndex === index ? 'bg-amber-500' : 'bg-white/50'"
                class="w-2 h-2 rounded-full transition-all duration-300"
            ></button>
        </template>
    </div>

    {{-- Navigation Arrows --}}
    <button
        @click="currentIndex = (currentIndex - 1 + images.length) % images.length"
        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition-all duration-300 z-10"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button
        @click="currentIndex = (currentIndex + 1) % images.length"
        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition-all duration-300 z-10"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
</div>
