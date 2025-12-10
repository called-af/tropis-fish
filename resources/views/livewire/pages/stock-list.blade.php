<div class="min-h-screen">
    <x-organisms.navbar />

    {{-- Hero Section --}}
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 bg-blue-600">
        <div class="max-w-7xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Stock List</h1>
            <p class="text-xl text-blue-50">Browse Our Complete Fish Collection</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for($i = 1; $i <= 16; $i++)
                    <x-molecules.product-card
                        name="Ikan Hias {{ $i }}"
                        price="{{ number_format(rand(10000, 200000)) }}"
                    />
                @endfor
            </div>
        </div>
    </section>

    <x-organisms.footer />
</div>
