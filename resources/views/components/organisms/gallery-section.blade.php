<section id="gallery" class="py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
    <div class="max-w-6xl mx-auto">
        <x-molecules.section-header
            title="Fish Gallery"
            description="Explore our beautiful and diverse collection of tropical ornamental fish"
        />

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @for($i = 1; $i <= 8; $i++)
                <x-molecules.gallery-item :index="$i" />
            @endfor
        </div>

        <div class="text-center mt-16">
            <x-atoms.button variant="outline" href="{{ route('gallery') }}">
                View All Gallery
            </x-atoms.button>
        </div>
    </div>
</section>
