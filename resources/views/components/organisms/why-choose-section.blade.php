<section class="py-24 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-10">
        <div class="absolute top-20 right-10 w-64 h-64 bg-amber-500 rounded-full animate-float blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-48 h-48 bg-blue-500 rounded-full animate-wave blur-3xl"></div>
    </div>

    <div class="max-w-6xl mx-auto relative z-10">
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            :class="visible ? 'opacity-100 translate-y-0 scale-100' : 'opacity-0 translate-y-8 scale-95'"
            class="transition-all duration-1000 ease-out"
        >
            <x-molecules.section-header
                title="Why Choose Us"
                description="Our commitment to delivering the best"
            />
        </div>

        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            class="grid md:grid-cols-2 gap-8 mt-12"
        >
            <div
                :class="visible ? 'opacity-100 translate-y-0 rotate-0' : 'opacity-0 translate-y-12 rotate-2'"
                class="transition-all duration-1000 ease-out stagger-1"
            >
                <x-molecules.why-choose-card
                    icon="check"
                    title="Own Breeding Center"
                    description="We own breeding facilities with 3000+ tanks to guarantee quality"
                />
            </div>
            <div
                :class="visible ? 'opacity-100 translate-y-0 rotate-0' : 'opacity-0 translate-y-12 -rotate-2'"
                class="transition-all duration-1000 ease-out stagger-2"
            >
                <x-molecules.why-choose-card
                    icon="user-group"
                    title="Experienced Expert Team"
                    description="Supported by breeding and export team with over 25 years of experience"
                />
            </div>
            <div
                :class="visible ? 'opacity-100 translate-y-0 rotate-0' : 'opacity-0 translate-y-12 -rotate-2'"
                class="transition-all duration-1000 ease-out stagger-3"
            >
                <x-molecules.why-choose-card
                    icon="globe"
                    title="Wide Coverage"
                    description="Serving delivery throughout Indonesia with the best packaging system"
                />
            </div>
            <div
                :class="visible ? 'opacity-100 translate-y-0 rotate-0' : 'opacity-0 translate-y-12 rotate-2'"
                class="transition-all duration-1000 ease-out stagger-4"
            >
                <x-molecules.why-choose-card
                    icon="shield"
                    title="Satisfaction Guarantee"
                    description="We guarantee your satisfaction with responsive after-sales service"
                />
            </div>
        </div>
    </div>
</section>
