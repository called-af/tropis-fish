<div class="min-h-screen">
    <x-organisms.navbar />

    {{-- Hero Section --}}
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 bg-blue-600">
        <div class="max-w-7xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Gallery</h1>
            <p class="text-xl text-blue-50">Our Beautiful Fish Collection</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @for($i = 1; $i <= 12; $i++)
                    <div class="group aspect-square bg-gradient-to-br from-blue-200 to-orange-200 rounded-2xl overflow-hidden cursor-pointer relative">
                        <div class="w-full h-full flex items-center justify-center transition-transform group-hover:scale-110 duration-300">
                            <svg class="w-16 h-16 text-white/50" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                            </svg>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                            <p class="text-white font-semibold">Fish Gallery #{{ $i }}</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <x-organisms.footer />
</div>
