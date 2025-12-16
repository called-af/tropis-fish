<section id="about" class="relative py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
    {{-- Wave Top --}}
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none">
        <svg class="relative block w-full h-20 md:h-28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <defs>
                <linearGradient id="waveGradient" x1="100%" y1="0%" x2="0%" y2="0%">
                    <stop offset="0%" style="stop-color:#f59e0b;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#fbbf24;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#d97706;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="url(#waveGradient)"></path>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto relative pt-20 z-10">
        {{-- Main About Section with Photo Left, Text Right --}}
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-1000 ease-out grid lg:grid-cols-2 gap-12 items-center mb-20"
        >
            {{-- Left: Photo --}}
            <div class="relative group">
                <div class="absolute -inset-4 bg-gradient-to-r from-amber-500 to-amber-600 rounded-2xl opacity-20 group-hover:opacity-30 blur-xl transition duration-300"></div>
                <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                    <img
                        src="{{ asset('assets/logo-pt.jpeg') }}"
                        alt="PT. Tropis Fish Indonesia"
                        class="w-full h-[500px] object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/50 to-transparent"></div>
                </div>
            </div>

            {{-- Right: About Text --}}
            <div class="space-y-6">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                        About Us
                    </h2>
                </div>

                <p class="text-lg text-white/90 leading-relaxed">
                    Since 1998, <span class="text-amber-400 font-semibold">PT. Tropis Fish Indonesia</span> has been at the forefront of breeding and distributing premium quality tropical ornamental fish. With over two decades of experience, we have established ourselves as one of Indonesia's most trusted suppliers of aquatic life.
                </p>

                <p class="text-lg text-white/90 leading-relaxed">
                    Our passion for aquatic excellence drives us to maintain the highest standards in fish breeding, health management, and customer service. We take pride in our commitment to sustainability and the well-being of every fish that leaves our facility.
                </p>

                <div class="grid sm:grid-cols-2 gap-6 pt-4">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-amber-400" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold mb-1">Premium Quality</h3>
                            <p class="text-white/70 text-sm">Carefully selected and quarantined fish</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                <x-heroicon-o-currency-dollar class="w-6 h-6 text-amber-400" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold mb-1">Best Prices</h3>
                            <p class="text-white/70 text-sm">Direct from our breeding center</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                <x-heroicon-o-truck class="w-6 h-6 text-amber-400" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold mb-1">Fast Delivery</h3>
                            <p class="text-white/70 text-sm">Professional packaging nationwide</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                <x-heroicon-o-heart class="w-6 h-6 text-amber-400" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold mb-1">Expert Care</h3>
                            <p class="text-white/70 text-sm">Dedicated team of specialists</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
