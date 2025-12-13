<section id="products" class="py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
    <div class="max-w-6xl mx-auto">
        <x-molecules.section-header
            title="Popular Products"
            description="The finest selection of ornamental fish with premium breeding quality"
        />

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
            <x-atoms.button variant="outline" href="{{ route('stock-list') }}">
                View All Products
            </x-atoms.button>
        </div>
    </div>
</section>
