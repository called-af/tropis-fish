<div class="min-h-screen bg-gradient-to-b from-blue-300 via-blue-600 to-black">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Hero Section --}}
    <section class="pt-40 pb-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-light text-white mb-6 tracking-tight">Gallery</h1>
            <div class="w-20 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mb-6"></div>
            <p class="text-lg text-gray-400 font-light">Our Beautiful Fish Collection</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @for($i = 1; $i <= 12; $i++)
                    <div class="group aspect-square bg-white/5 border border-white/10 hover:border-amber-500/50 overflow-hidden cursor-pointer relative transition-all duration-500">
                        <div class="w-full h-full flex items-center justify-center transition-all duration-500 group-hover:scale-110">
                            <x-heroicon-o-photo class="w-16 h-16 text-gray-600 group-hover:text-amber-500 transition-colors duration-300" />
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <p class="text-white font-light text-sm tracking-wide">Fish Gallery #{{ $i }}</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <x-organisms.footer />
</div>
