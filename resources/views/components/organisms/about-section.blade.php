<section id="about" class="relative py-24 px-4 sm:px-6 lg:px-8 border-b border-white/5">
    {{-- Wave Top --}}
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none">
        <svg class="relative block w-full h-20 md:h-28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <defs>
                <linearGradient id="waveGradient" x1="100%" y1="0%" x2="0%" y2="0%">
                    <stop offset="0%" style="stop-color:#f59e0b;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#fbbf24;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#d97706;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="url(#waveGradient)"></path>
        </svg>
    </div>

    <div class="max-w-6xl mx-auto relative z-10">
        <x-molecules.section-header
            title="About Us"
            description="Since 1998, we have been pioneers in breeding and distributing premium quality tropical ornamental fish"
        />

        <div class="grid md:grid-cols-3 gap-12">
            <x-molecules.feature-card
                icon="check"
                title="Guaranteed Quality"
                description="All our fish are carefully selected and go through quarantine processes to ensure optimal health"
            />
            <x-molecules.feature-card
                icon="money"
                title="Affordable Prices"
                description="Competitive pricing directly from our breeding center without burdensome intermediaries"
            />
            <x-molecules.feature-card
                icon="lightning"
                title="Fast Delivery"
                description="Professional packaging with oxygen system for safe delivery throughout Indonesia"
            />
        </div>
    </div>
</section>
