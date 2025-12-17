<div class="min-h-screen bg-gradient-to-b from-blue-400 via-blue-600 via-blue-900 to-black">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Hero Section --}}
    <section class="pt-40 pb-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-light text-white mb-6 tracking-tight">Terms & Conditions</h1>
            <div class="w-20 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mb-6"></div>
            <p class="text-lg text-gray-300 font-light">Please read our terms carefully</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto space-y-12">
            {{-- Price --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-amber-500 flex items-center gap-3">
                    <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                    Price
                </h2>
                <p class="text-gray-200 leading-relaxed text-lg pl-5">
                    All the prices quote here is F.O.B from Jakarta – Indonesia, with US Dollar (USD). The prices can be changed anytime without prior notice.
                </p>
            </div>

            {{-- Delivery Order --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-amber-500 flex items-center gap-3">
                    <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                    Delivery Order
                </h2>
                <p class="text-gray-200 leading-relaxed text-lg pl-5">
                    A minimum of 7 (seven) days order notice prior to shipment as highly advisable to ensure proper conditioning of fishes. For the seasonal fishes, please inquire ordering to ensuring the availability.
                </p>
            </div>

            {{-- Packing --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-amber-500 flex items-center gap-3">
                    <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                    Packing
                </h2>
                <div class="text-gray-200 leading-relaxed text-lg pl-5 space-y-3">
                    <p>
                        All fishes are packing in double plastic bags. Our packing bag and box are IATA standard, and we use styrofoam, plastic bag, and carton box for packing.
                    </p>
                    <p>
                        One box normally content of 4 bags with double plastic bags for safety with box dimension 60 x 40 x 32cm, and have another box also which could content of 6 bags, with box dimension 75 x 40 x 32cm.
                    </p>
                </div>
            </div>

            {{-- Dimension --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-amber-500 flex items-center gap-3">
                    <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                    Dimension
                </h2>
                <div class="text-gray-200 leading-relaxed text-lg pl-5 space-y-4">
                    <p>We use two types of boxes, there are:</p>
                    <div class="space-y-3">
                        <div class="bg-blue-950/20 backdrop-blur-sm border border-amber-500/20 rounded-lg p-4">
                            <div class="flex items-start gap-3">
                                <span class="text-amber-500 font-bold">1)</span>
                                <div>
                                    <p class="font-semibold text-white mb-1">60 x 40 x 32 cm</p>
                                    <p class="text-gray-300">Actual weight 15kgs for freshwater fishes. Estimated weight 14-16 kgs (4 bags).</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-blue-950/20 backdrop-blur-sm border border-amber-500/20 rounded-lg p-4">
                            <div class="flex items-start gap-3">
                                <span class="text-amber-500 font-bold">2)</span>
                                <div>
                                    <p class="font-semibold text-white mb-1">75 x 40 x 32 cm</p>
                                    <p class="text-gray-300">Actual weight 17kgs. Estimated weight 17-20kgs (6 bags).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-300">
                        For total weight of boxes, it depends of the weight of fishes, and packing density for each box.
                    </p>
                </div>
            </div>

            {{-- Claim for D.O.A. --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-amber-500 flex items-center gap-3">
                    <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                    Claim for D.O.A.
                </h2>
                <p class="text-gray-200 leading-relaxed text-lg pl-5">
                    Complain only received within 24 hours after the shipment arrival. Any shipment without news in 24 hours after the arrival, must be accepted well by consignee.
                </p>
            </div>

            {{-- Payment --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-amber-500 flex items-center gap-3">
                    <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                    Payment
                </h2>
                <p class="text-gray-200 leading-relaxed text-lg pl-5">
                    For new buyer, advance payment in full is required prior to shipment. Credit terms can be negotiated upon the establishment of regular business.
                </p>
            </div>
        </div>
    </section>

    <x-organisms.footer />
</div>
