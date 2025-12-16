<section class="py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div
            x-data="{ visible: false }"
            x-intersect:enter="visible = true"
            x-intersect:leave="visible = false"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
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
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-1000 ease-out delay-200 grid md:grid-cols-2 gap-8"
        >
            <x-molecules.why-choose-card
                icon="check"
                title="Own Breeding Center"
                description="We own breeding facilities with 3000+ tanks to guarantee quality"
            />
            <x-molecules.why-choose-card
                icon="user-group"
                title="Experienced Expert Team"
                description="Supported by breeding and export team with over 25 years of experience"
            />
            <x-molecules.why-choose-card
                icon="globe"
                title="Wide Coverage"
                description="Serving delivery throughout Indonesia with the best packaging system"
            />
            <x-molecules.why-choose-card
                icon="shield"
                title="Satisfaction Guarantee"
                description="We guarantee your satisfaction with responsive after-sales service"
            />
        </div>
    </div>
</section>
