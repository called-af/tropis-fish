<div class="min-h-screen bg-gradient-to-b from-blue-400 via-blue-600 via-blue-900 to-black">
    <x-organisms.navbar />

    {{-- Scroll to Top Button --}}
    <x-atoms.scroll-to-top />

    {{-- Hero Section --}}
    <section class="pt-40 pb-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-light text-white mb-6 tracking-tight">Stock List</h1>
            <div class="w-20 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mb-6"></div>
            <p class="text-lg text-gray-400 font-light">Browse Our Complete Fish Collection</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
                    code="SWD-004"
                    scientificName="Xiphophorus hellerii"
                    commonName="Swordtail Red"
                    size="Small"
                    length="8"
                />
                <x-molecules.product-card
                    code="TET-005"
                    scientificName="Paracheirodon innesi"
                    commonName="Neon Tetra"
                    size="Small"
                    length="3"
                />
                <x-molecules.product-card
                    code="DIS-006"
                    scientificName="Symphysodon aequifasciatus"
                    commonName="Discus Blue Diamond"
                    size="Large"
                    length="18"
                />
                <x-molecules.product-card
                    code="ANG-007"
                    scientificName="Pterophyllum scalare"
                    commonName="Angelfish Marble"
                    size="Medium"
                    length="12"
                />
                <x-molecules.product-card
                    code="COR-008"
                    scientificName="Corydoras paleatus"
                    commonName="Corydoras Peppered"
                    size="Small"
                    length="5"
                />
                <x-molecules.product-card
                    code="KOI-009"
                    scientificName="Cyprinus carpio"
                    commonName="Koi Kohaku"
                    size="Extra Large"
                    length="35"
                />
                <x-molecules.product-card
                    code="ARW-010"
                    scientificName="Scleropages formosus"
                    commonName="Arwana Super Red"
                    size="Large"
                    length="45"
                />
                <x-molecules.product-card
                    code="OSC-011"
                    scientificName="Astronotus ocellatus"
                    commonName="Oscar Tiger"
                    size="Medium"
                    length="25"
                />
                <x-molecules.product-card
                    code="LHN-012"
                    scientificName="Cichlasoma trimaculatum"
                    commonName="Louhan Kamfa"
                    size="Large"
                    length="30"
                />
                <x-molecules.product-card
                    code="GLD-013"
                    scientificName="Carassius auratus"
                    commonName="Goldfish Ranchu"
                    size="Medium"
                    length="12"
                />
                <x-molecules.product-card
                    code="BTA-014"
                    scientificName="Betta splendens"
                    commonName="Betta Halfmoon"
                    size="Small"
                    length="6"
                />
                <x-molecules.product-card
                    code="GRM-015"
                    scientificName="Trichogaster lalius"
                    commonName="Gourami Dwarf"
                    size="Small"
                    length="5"
                />
                <x-molecules.product-card
                    code="RAB-016"
                    scientificName="Hyphessobrycon eques"
                    commonName="Serpae Tetra"
                    size="Small"
                    length="4"
                />
            </div>
        </div>
    </section>

    <x-organisms.footer />
</div>
