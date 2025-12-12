<div class="min-h-screen bg-gradient-to-b from-blue-400 via-blue-600 via-blue-900 to-black">
    {{-- Navbar --}}
    <x-organisms.navbar />

    {{-- Hero Slider with Video Background --}}
    <x-organisms.hero-slider />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Stats Section --}}
    <section class="py-14 px-4 sm:px-6 lg:px-8 bg-gradient-to-l from-amber-500 via-amber-400 to-amber-600 border-b border-white/5">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10 space-y-4">
                <h2 class="text-3xl md:text-5xl font-bold text-black tracking-tight">
                    Trusted by Thousands of Customers
                </h2>
                <p class="text-lg text-gray-900 font-light max-w-2xl mx-auto">
                    Our experience and dedication in the ornamental fish industry
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <x-molecules.stat-card value="25" suffix="+" label="Years of Experience" />
                <x-molecules.stat-card value="500" suffix="+" label="Fish Species" />
                <x-molecules.stat-card value="3000" suffix="+" label="Fish Tanks" />
                <x-molecules.stat-card value="10K" suffix="+" label="Happy Customers" />
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section id="about" class="py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-light text-white mb-6 tracking-tight">
                    About Us
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent mx-auto mb-6"></div>
                <p class="text-lg text-gray-400 font-light max-w-3xl mx-auto leading-relaxed">
                    Since 1998, we have been pioneers in breeding and distributing premium quality tropical ornamental fish
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <x-molecules.feature-card
                    icon="check"
                    title="Guaranteed Quality"
                    description="All our fish are carefully selected and go through quarantine processes to ensure optimal health"
                />
                <x-molecules.feature-card
                    icon="money"
                    title="Affordable Prices"
                    description="Competitive pricing directly from our breeding center without burdensome intermediaries"
                />
                <x-molecules.feature-card
                    icon="lightning"
                    title="Fast Delivery"
                    description="Professional packaging with oxygen system for safe delivery throughout Indonesia"
                />
            </div>
        </div>
    </section>

    {{-- Category Section --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-light text-white mb-6 tracking-tight">
                    Fish Categories
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent mx-auto mb-6"></div>
                <p class="text-lg text-gray-400 font-light max-w-2xl mx-auto">
                    Explore our diverse selection of ornamental fish categories
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <x-molecules.category-card name="Guppy Fish" count="20" />
                <x-molecules.category-card name="Molly Fish" count="15" />
                <x-molecules.category-card name="Tetra Fish" count="25" />
                <x-molecules.category-card name="Discus Fish" count="12" />
            </div>
        </div>
    </section>

    {{-- Products Section --}}
    <section id="products" class="py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-light text-white mb-6 tracking-tight">
                    Popular Products
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent mx-auto mb-6"></div>
                <p class="text-lg text-gray-400 font-light max-w-2xl mx-auto">
                    The finest selection of ornamental fish with premium breeding quality
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <x-molecules.product-card
                    code="GUP-001"
                    scientificName="Poecilia reticulata"
                    commonName="Guppy Fancy"
                    size="Small"
                    length="4"
                />
                <x-molecules.product-card
                    code="MOL-002"
                    scientificName="Poecilia sphenops"
                    commonName="Molly Black"
                    size="Small"
                    length="6"
                />
                <x-molecules.product-card
                    code="PLT-003"
                    scientificName="Xiphophorus maculatus"
                    commonName="Platy Rainbow"
                    size="Small"
                    length="5"
                />
                <x-molecules.product-card
                    code="TET-004"
                    scientificName="Paracheirodon innesi"
                    commonName="Neon Tetra"
                    size="Small"
                    length="3"
                />
                <x-molecules.product-card
                    code="DIS-005"
                    scientificName="Symphysodon aequifasciatus"
                    commonName="Discus Blue Diamond"
                    size="Large"
                    length="18"
                />
                <x-molecules.product-card
                    code="ANG-006"
                    scientificName="Pterophyllum scalare"
                    commonName="Angelfish Marble"
                    size="Medium"
                    length="12"
                />
                <x-molecules.product-card
                    code="COR-007"
                    scientificName="Corydoras paleatus"
                    commonName="Corydoras Peppered"
                    size="Small"
                    length="5"
                />
                <x-molecules.product-card
                    code="KOI-008"
                    scientificName="Cyprinus carpio"
                    commonName="Koi Kohaku"
                    size="Extra Large"
                    length="35"
                />
            </div>

            <div class="text-center mt-16">
                <a href="{{ route('stock-list') }}" class="inline-flex items-center px-8 py-3 border border-orange-500/50 text-orange-400 hover:bg-orange-500/10 hover:border-orange-500 transition-all duration-300 font-light tracking-wide">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    {{-- Gallery Section --}}
    <section id="gallery" class="py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-light text-white mb-6 tracking-tight">
                    Fish Gallery
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent mx-auto mb-6"></div>
                <p class="text-lg text-gray-400 font-light max-w-2xl mx-auto">
                    Explore our beautiful and diverse collection of tropical ornamental fish
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @for($i = 1; $i <= 8; $i++)
                    <div class="group aspect-square bg-white/5 border border-white/10 hover:border-orange-500/50 overflow-hidden cursor-pointer relative transition-all duration-500">
                        <div class="w-full h-full flex items-center justify-center transition-all duration-500 group-hover:scale-110">
                            <x-heroicon-o-photo class="w-16 h-16 text-gray-600 group-hover:text-orange-500 transition-colors duration-300" />
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <p class="text-white font-light text-sm tracking-wide">Ornamental Fish #{{ $i }}</p>
                        </div>
                    </div>
                @endfor
            </div>

            <div class="text-center mt-16">
                <a href="{{ route('gallery') }}" class="inline-flex items-center px-8 py-3 border border-orange-500/50 text-orange-400 hover:bg-orange-500/10 hover:border-orange-500 transition-all duration-300 font-light tracking-wide">
                    View All Gallery
                </a>
            </div>
        </div>
    </section>

    {{-- Why Choose Us Section --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-light text-white mb-6 tracking-tight">
                    Why Choose Us
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent mx-auto mb-6"></div>
                <p class="text-lg text-gray-400 font-light max-w-2xl mx-auto">
                    Our commitment to delivering the best
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="group p-8 bg-white/5 border border-white/10 hover:border-orange-500/30 transition-all duration-500">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 border border-orange-500/50 flex items-center justify-center group-hover:bg-orange-500/10 transition-all duration-300">
                                <x-heroicon-o-check class="w-6 h-6 text-orange-500" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-light text-white mb-3 tracking-wide">Own Breeding Center</h3>
                            <p class="text-gray-400 font-light leading-relaxed">
                                We own breeding facilities with 3000+ tanks to guarantee quality
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group p-8 bg-white/5 border border-white/10 hover:border-orange-500/30 transition-all duration-500">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 border border-orange-500/50 flex items-center justify-center group-hover:bg-orange-500/10 transition-all duration-300">
                                <x-heroicon-o-user-group class="w-6 h-6 text-orange-500" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-light text-white mb-3 tracking-wide">Experienced Expert Team</h3>
                            <p class="text-gray-400 font-light leading-relaxed">
                                Supported by breeding and export team with over 25 years of experience
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group p-8 bg-white/5 border border-white/10 hover:border-orange-500/30 transition-all duration-500">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 border border-orange-500/50 flex items-center justify-center group-hover:bg-orange-500/10 transition-all duration-300">
                                <x-heroicon-o-globe-asia-australia class="w-6 h-6 text-orange-500" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-light text-white mb-3 tracking-wide">Wide Coverage</h3>
                            <p class="text-gray-400 font-light leading-relaxed">
                                Serving delivery throughout Indonesia with the best packaging system
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group p-8 bg-white/5 border border-white/10 hover:border-orange-500/30 transition-all duration-500">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 border border-orange-500/50 flex items-center justify-center group-hover:bg-orange-500/10 transition-all duration-300">
                                <x-heroicon-o-shield-check class="w-6 h-6 text-orange-500" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-light text-white mb-3 tracking-wide">Satisfaction Guarantee</h3>
                            <p class="text-gray-400 font-light leading-relaxed">
                                We guarantee your satisfaction with responsive after-sales service
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <x-organisms.footer />
</div>
