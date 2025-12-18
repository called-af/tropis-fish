<div class="min-h-screen bg-blue-950">
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
            @php
                $terms = App\Models\Term::getActive();
            @endphp

            @forelse($terms as $term)
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold text-amber-500 flex items-center gap-3">
                        <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                        {{ $term->title }}
                    </h2>
                    <div class="text-gray-200 leading-relaxed text-lg pl-5 space-y-3 whitespace-pre-line">
                        {{ $term->content }}
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">No terms available at the moment.</p>
                </div>
            @endforelse
        </div>
    </section>

    <x-organisms.footer />
</div>
