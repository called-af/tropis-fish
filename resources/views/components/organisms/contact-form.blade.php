<div class="relative group h-full">

    {{-- Main Form Card --}}
    <div class="relative bg-white/5 hover:border-amber-500/30 p-8 transition-all duration-500 h-full">
        {{-- Form Header --}}
        <div class="mb-6 pb-6 border-b border-amber-500/30">
            <h3 class="text-xl font-bold text-amber-500 flex items-center gap-3">
                <x-heroicon-o-envelope class="w-6 h-6" />
                Send us a Message
            </h3>
            <p class="text-sm text-gray-400 mt-2">Fill out the form below and we'll get back to you shortly</p>
        </div>

        <form class="space-y-5">
            <div class="grid md:grid-cols-2 gap-5">
                <x-atoms.input
                    type="text"
                    label="Your Name"
                    placeholder="John Doe"
                    name="name"
                    variant="outline"
                    required
                />

                <x-atoms.input
                    type="email"
                    label="Your Email"
                    placeholder="john@example.com"
                    name="email"
                    variant="outline"
                    required
                />
            </div>

            <x-atoms.input
                type="text"
                label="Subject"
                placeholder="What is this about?"
                name="subject"
                variant="outline"
                required
            />

            <x-atoms.textarea
                label="Your Message"
                placeholder="Tell us more about your inquiry..."
                name="message"
                rows="5"
                variant="outline"
                required
            />

            <div class="flex items-center justify-between pt-4">
                <div class="flex items-center gap-2 text-sm text-gray-400">
                    <x-heroicon-o-shield-check class="w-4 h-4 text-amber-500" />
                    <span>Your information is secure</span>
                </div>
                <x-atoms.button
                    type="submit"
                    variant="secondary"
                    size="lg"
                    icon="arrow-right"
                    iconPosition="right"
                    class="shadow-lg shadow-amber-500/30"
                >
                    Send Message
                </x-atoms.button>
            </div>
        </form>
    </div>
</div>
