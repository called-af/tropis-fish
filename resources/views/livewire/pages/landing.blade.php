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

    {{-- Company About Section --}}
    <x-organisms.company-about-section />

    {{-- Farm Section --}}
    <x-organisms.company-farm-section />

    {{-- Quality Control Section --}}
    <x-organisms.company-quality-section />

    {{-- Products Section --}}
    <x-organisms.products-section :stockLists="$stockLists" :downloadLink="$downloadLink" />

    {{-- Gallery Section --}}
    <x-organisms.gallery-section :galleries="$galleries" />

    {{-- Why Choose Us Section --}}
    <x-organisms.why-choose-section />

    {{-- Contact Section --}}
    <section id="contact"
        class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-transparent to-black relative overflow-hidden">

        <div class="max-w-6xl mx-auto relative z-10">
            <div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out">
                <x-molecules.section-header title="Contact Us"
                    description="Get in touch with us for inquiries and orders" />
            </div>

            <div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-1000 ease-out delay-200 grid grid-cols-1 lg:grid-cols-5 gap-8 sm:gap-10 lg:gap-8">
                {{-- Contact Info - 2 columns --}}
                <div class="lg:col-span-2 space-y-8 sm:space-y-10">
                    {{-- Header with Logo --}}
                    <div x-data="{ visible: false }" x-intersect:enter="visible = true"
                        :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                        class="transition-all duration-700">
                        <div class="flex items-center gap-4 mb-4">
                            @php
                                $companyLogo = App\Models\Setting::get('company_logo');
                                $companyName = App\Models\Setting::get('company_name', 'PT. Tropis Fish Indonesia');
                            @endphp
                            <img src="{{ $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg') }}"
                                alt="{{ $companyName }} Logo"
                                class="w-16 h-16 sm:w-20 sm:h-20 rounded-full object-cover border-4 border-amber-500 shadow-lg">
                            <div class="flex flex-col space-y-4">
                                <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white tracking-wide">
                                    PT. TROPIS FISH
                                </h3>
                                <div
                                    class="h-1 w-20 sm:w-24 bg-gradient-to-r from-amber-500 to-transparent rounded-full">
                                </div>
                                <p class="text-amber-500 font-semibold text-base sm:text-lg">Export of Ornamental
                                    Freshwater Fish</p>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Details --}}
                    <div x-data="{ visible: false }" x-intersect:enter="visible = true"
                        :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                        class="transition-all duration-700 delay-100 space-y-4 sm:space-y-5">
                        <div>
                            <h4 class="text-amber-500 font-bold text-xs sm:text-sm uppercase tracking-wider mb-2">
                                Address</h4>
                            <p class="text-gray-300 text-sm sm:text-base break-words">Gg. Nona Merah No.42, Cibitung
                                Bekasi-Indonesia</p>
                        </div>

                        <div>
                            <h4 class="text-amber-500 font-bold text-xs sm:text-sm uppercase tracking-wider mb-2">Phone
                            </h4>
                            <a href="tel:+622188326953"
                                class="text-gray-300 text-sm sm:text-base hover:text-amber-500 transition">+62-21-8832
                                6953</a>
                        </div>

                        <div>
                            <h4 class="text-amber-500 font-bold text-xs sm:text-sm uppercase tracking-wider mb-2">Fax
                            </h4>
                            <p class="text-gray-300 text-sm sm:text-base">+62-21-8833 9221</p>
                        </div>

                        <div>
                            <h4 class="text-amber-500 font-bold text-xs sm:text-sm uppercase tracking-wider mb-2">Email
                            </h4>
                            <a href="mailto:sales@tropisfish.com"
                                class="text-gray-300 text-sm sm:text-base hover:text-amber-500 transition break-all">sales@tropisfish.com</a>
                        </div>
                    </div>

                    {{-- Business Hours --}}
                    <div x-data="{ visible: false }" x-intersect:enter="visible = true"
                        :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                        class="transition-all duration-700 delay-200">
                        <div
                            class="border-l-4 border-amber-500/50 pl-3 sm:pl-4 hover:border-amber-500 transition-colors duration-300">
                            <h4 class="font-bold text-amber-500 text-sm sm:text-base mb-2">Business Hours</h4>
                            <p class="text-gray-300 text-xs sm:text-sm">Monday - Saturday: 08:00 - 17:00</p>
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

    {{-- Terms Modal --}}
    <x-organisms.terms-modal />
</div>