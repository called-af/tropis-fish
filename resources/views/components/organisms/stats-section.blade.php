@props(['stats' => [], 'title' => 'Trusted by Thousands of Customers', 'description' => 'Our experience and dedication in the ornamental fish industry'])

<section class="py-14 px-4 sm:px-6 lg:px-8 bg-gradient-to-l from-amber-500 via-amber-400 to-amber-600">
    <div class="max-w-6xl mx-auto">
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-1000 ease-out text-center mb-10 space-y-4"
        >
            <h2 class="text-4xl md:text-6xl font-extrabold text-black tracking-tight">
                {{ $title }}
            </h2>
            <p class="text-lg text-gray-900 font-bold max-w-2xl mx-auto">
                {{ $description }}
            </p>
        </div>

        @if(count($stats) > 0)
            <div
                x-data="{ visible: false }"
                x-intersect:enter="visible = true"
                x-intersect:leave="visible = false"
                class="grid grid-cols-2 md:grid-cols-4 gap-8"
            >
                @foreach($stats as $index => $stat)
                    <div
                        :class="visible ? 'opacity-100 translate-y-0 scale-100' : 'opacity-0 translate-y-12 scale-90'"
                        class="transition-all duration-1000 ease-out stagger-{{ $index + 1 }}"
                    >
                        <x-molecules.stat-card
                            :value="$stat->value"
                            :label="$stat->label"
                        />
                    </div>
                @endforeach
            </div>

        @endif
    </div>
</section>
