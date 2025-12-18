<div class="min-h-screen bg-gradient-to-b bg-blue-950">
    {{-- Navbar --}}
    <x-organisms.navbar />

    {{-- Hero Slider with Video Background --}}
    <x-organisms.hero-slider :heroes="$heroes" />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Stats Section --}}
    <x-organisms.stats-section :stats="$stats" :title="$statsTitle" :description="$statsDescription" />

    {{-- About Section --}}
    <x-organisms.about-section :aboutSection="$aboutSection" />

    {{-- Products Section --}}
    <x-organisms.products-section :stockLists="$stockLists" :downloadLink="$downloadLink" />

    {{-- Gallery Section --}}
    <x-organisms.gallery-section :galleries="$galleries" />

    {{-- Why Choose Us Section --}}
    <x-organisms.why-choose-section />

    {{-- Contact Section --}}
    <section id="contact" class="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-transparent to-black relative overflow-hidden">

        <div class="max-w-6xl mx-auto relative z-10">
            <div
                x-data="{ visible: false }"
                x-intersect:enter="visible = true"
                x-intersect:leave="visible = false"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out"
            >
                <x-molecules.section-header
                    title="Contact Us"
                    description="Get in touch with us for inquiries and orders"
                />
            </div>

            <div
                x-data="{ visible: false }"
                x-intersect:enter="visible = true"
                x-intersect:leave="visible = false"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out delay-200 grid lg:grid-cols-5 gap-8"
            >
                {{-- Contact Info - 2 columns --}}
                <div class="lg:col-span-2 space-y-10">
                    {{-- Header --}}
                    <div
                        x-data="{ visible: false }"
                        x-intersect:enter="visible = true"
                        :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                        class="transition-all duration-700"
                    >
                        <h3 class="text-4xl font-bold text-white tracking-wide mb-2">
                            PT. TROPIS FISH
                        </h3>
                        <p class="text-amber-500 font-semibold text-lg mb-4">Export of Ornamental Freshwater Fish</p>
                        <div class="h-1 w-24 bg-gradient-to-r from-amber-500 to-transparent rounded-full"></div>
                    </div>

                    {{-- Contact Details --}}
                    <div
                        x-data="{ visible: false }"
                        x-intersect:enter="visible = true"
                        :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                        class="transition-all duration-700 delay-100 space-y-5"
                    >
                        <div>
                            <h4 class="text-amber-500 font-bold text-sm uppercase tracking-wider mb-2">Address</h4>
                            <p class="text-gray-300 text-base">Gg. Nona Merah No.42, Cibitung Bekasi-Indonesia</p>
                        </div>

                        <div>
                            <h4 class="text-amber-500 font-bold text-sm uppercase tracking-wider mb-2">Phone</h4>
                            <p class="text-gray-300 text-base">+62-21-8832 6953</p>
                        </div>

                        <div>
                            <h4 class="text-amber-500 font-bold text-sm uppercase tracking-wider mb-2">Fax</h4>
                            <p class="text-gray-300 text-base">+62-21-8833 9221</p>
                        </div>

                        <div>
                            <h4 class="text-amber-500 font-bold text-sm uppercase tracking-wider mb-2">Email</h4>
                            <p class="text-gray-300 text-base">sales@tropisfish.com</p>
                        </div>
                    </div>

                    {{-- Business Hours --}}
                    <div
                        x-data="{ visible: false }"
                        x-intersect:enter="visible = true"
                        :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                        class="transition-all duration-700 delay-200"
                    >
                        <div class="border-l-4 border-amber-500/50 pl-4 hover:border-amber-500 transition-colors duration-300">
                            <h4 class="font-bold text-amber-500 text-base mb-2">Business Hours</h4>
                            <p class="text-gray-300 text-sm">Monday - Saturday: 08:00 - 17:00</p>
                            <p class="text-gray-400 text-xs mt-1">Sunday: Closed</p>
                        </div>
                    </div>
                </div>

                {{-- Contact Form - 3 columns --}}
                <div class="lg:col-span-3">
                    <livewire:contact-form />
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <x-organisms.footer />
</div>
