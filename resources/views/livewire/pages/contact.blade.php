<div class="min-h-screen">
    <x-organisms.navbar />

    {{-- Hero Section --}}
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 bg-blue-600">
        <div class="max-w-7xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Contact Us</h1>
            <p class="text-xl text-blue-50">Get in touch with us</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200">
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-orange-600 text-transparent bg-clip-text mb-6">
                            Informasi Kontak
                        </h3>
                        <div class="space-y-6">
                            <x-molecules.contact-info icon="phone" title="Telepon" value="+62 812-3456-7890" />
                            <x-molecules.contact-info icon="mail" title="Email" value="info@tropisfish.com" />
                            <x-molecules.contact-info icon="location" title="Alamat" value="Jl. Akuarium Raya No. 123, Jakarta Selatan" />
                            <x-molecules.contact-info icon="clock" title="Jam Buka" value="Senin - Sabtu: 08:00 - 17:00" />
                        </div>
                    </div>
                </div>
                <div>
                    <x-organisms.contact-form />
                </div>
            </div>
        </div>
    </section>

    <x-organisms.footer />
</div>
