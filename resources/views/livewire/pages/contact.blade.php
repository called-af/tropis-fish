<div class="min-h-screen bg-gradient-to-b from-blue-400 via-blue-600 via-blue-900 to-black">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Hero Section --}}
    <section class="pt-40 pb-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-light text-white mb-6 tracking-tight">Contact Us</h1>
            <div class="w-20 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mb-6"></div>
            <p class="text-lg text-gray-400 font-light">Get in touch with us</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12">
                <div class="space-y-6">
                    <div class="bg-white/5 border border-white/10 p-10">
                        <h3 class="text-2xl font-light text-white mb-8 tracking-wide">
                            Contact Information
                        </h3>
                        <div class="space-y-6">
                            <x-molecules.contact-info icon="phone" title="Phone" value="+62 812-3456-7890" />
                            <x-molecules.contact-info icon="mail" title="Email" value="info@tropisfish.com" />
                            <x-molecules.contact-info icon="location" title="Address" value="Jl. Akuarium Raya No. 123, South Jakarta" />
                            <x-molecules.contact-info icon="clock" title="Opening Hours" value="Monday - Saturday: 08:00 - 17:00" />
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
