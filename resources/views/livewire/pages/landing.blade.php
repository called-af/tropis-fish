<div class="min-h-screen bg-white">
    {{-- Navbar --}}
    <x-organisms.navbar />

    {{-- Hero Slider with Video Background --}}
    <x-organisms.hero-slider />

    {{-- WhatsApp Floating Button --}}
    <x-atoms.whatsapp-button />

    {{-- Stats Section --}}
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Dipercaya oleh Ribuan Pelanggan
                </h2>
                <p class="text-lg text-gray-600">
                    Pengalaman dan dedikasi kami dalam industri ikan hias
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <x-molecules.stat-card value="25" suffix="+" label="Tahun Pengalaman" />
                <x-molecules.stat-card value="500" suffix="+" label="Jenis Ikan" />
                <x-molecules.stat-card value="3000" suffix="+" label="Tangki Ikan" />
                <x-molecules.stat-card value="10K" suffix="+" label="Pelanggan Puas" />
            </div>
        </div>
    </section>

    {{-- Tentang Section --}}
    <section id="tentang" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Tentang Kami
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Sejak 1998, kami telah menjadi pelopor dalam breeding dan distribusi ikan hias tropis berkualitas premium
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <x-molecules.feature-card
                    icon="check"
                    title="Kualitas Terjamin"
                    description="Semua ikan kami dipilih dengan teliti dan melalui proses karantina untuk memastikan kesehatan optimal"
                />
                <x-molecules.feature-card
                    icon="money"
                    title="Harga Terjangkau"
                    description="Harga kompetitif langsung dari breeding center tanpa perantara yang membebani"
                />
                <x-molecules.feature-card
                    icon="lightning"
                    title="Pengiriman Cepat"
                    description="Packaging profesional dengan sistem oksigen untuk pengiriman aman ke seluruh Indonesia"
                />
            </div>
        </div>
    </section>

    {{-- Category Section --}}
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Kategori Ikan
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jelajahi berbagai kategori ikan hias pilihan kami
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <x-molecules.category-card name="Ikan Guppy" count="20" />
                <x-molecules.category-card name="Ikan Molly" count="15" />
                <x-molecules.category-card name="Ikan Tetra" count="25" />
                <x-molecules.category-card name="Ikan Discus" count="12" />
            </div>
        </div>
    </section>

    {{-- Produk Section --}}
    <section id="produk" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Produk Populer
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Ikan hias pilihan terbaik dengan kualitas breeding premium
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <x-molecules.product-card name="Ikan Guppy" price="15.000" />
                <x-molecules.product-card name="Ikan Molly" price="20.000" />
                <x-molecules.product-card name="Ikan Platy" price="18.000" />
                <x-molecules.product-card name="Ikan Tetra" price="25.000" />
                <x-molecules.product-card name="Ikan Discus" price="150.000" />
                <x-molecules.product-card name="Ikan Angelfish" price="45.000" />
                <x-molecules.product-card name="Ikan Neon" price="12.000" />
                <x-molecules.product-card name="Ikan Koi" price="80.000" />
            </div>

            <div class="text-center mt-12">
                <x-atoms.button variant="primary" size="lg" href="{{ route('stock-list') }}">
                    Lihat Semua Produk
                </x-atoms.button>
            </div>
        </div>
    </section>

    {{-- Galeri Section --}}
    <section id="galeri" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Galeri Ikan
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Lihat koleksi foto ikan hias tropis kami yang indah dan beragam
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @for($i = 1; $i <= 8; $i++)
                    <div class="group aspect-square bg-gray-200 rounded-2xl overflow-hidden cursor-pointer relative">
                        <div class="w-full h-full flex items-center justify-center transition-transform group-hover:scale-110 duration-300">
                            <svg class="w-16 h-16 text-white/50" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                            </svg>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                            <p class="text-white font-semibold">Ikan Hias #{{ $i }}</p>
                        </div>
                    </div>
                @endfor
            </div>

            <div class="text-center mt-12">
                <x-atoms.button variant="secondary" size="lg" href="{{ route('gallery') }}">
                    Lihat Semua Galeri
                </x-atoms.button>
            </div>
        </div>
    </section>

    {{-- Testimonial/Why Choose Us --}}
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih Kami?
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Komitmen kami untuk memberikan yang terbaik
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="flex gap-4 p-6 bg-gray-50 rounded-2xl border border-gray-200">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Breeding Center Sendiri</h3>
                        <p class="text-gray-600">
                            Kami memiliki fasilitas breeding sendiri dengan 3000+ tangki untuk menjamin kualitas
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 p-6 bg-gray-50 rounded-2xl border border-gray-200">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tim Ahli Berpengalaman</h3>
                        <p class="text-gray-600">
                            Didukung tim breeding dan export yang berpengalaman lebih dari 25 tahun
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 p-6 bg-gray-50 rounded-2xl border border-gray-200">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Jangkauan Luas</h3>
                        <p class="text-gray-600">
                            Melayani pengiriman ke seluruh Indonesia dengan sistem packaging terbaik
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 p-6 bg-gray-50 rounded-2xl border border-gray-200">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Garansi Kepuasan</h3>
                        <p class="text-gray-600">
                            Kami menjamin kepuasan Anda dengan layanan after-sales yang responsif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <x-organisms.footer />
</div>
