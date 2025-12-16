<div class="relative group h-full">
    @if (session()->has('contact_success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 5000)"
            class="mb-6 bg-green-900/50 border border-green-700 text-green-300 px-6 py-4 rounded-xl flex items-center justify-between"
            role="alert"
        >
            <div class="flex items-center gap-3">
                <x-heroicon-o-check-circle class="w-5 h-5" />
                <span class="font-medium">{{ session('contact_success') }}</span>
            </div>
            <button @click="show = false" class="text-green-300 hover:text-green-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>
    @endif

    {{-- Main Form Card --}}
    <div class="relative bg-white/5 border border-white/10 hover:border-amber-500/30 p-8 transition-all duration-500 h-full">
        {{-- Form Header --}}
        <div class="mb-6 pb-6 border-b border-amber-500/30">
            <h3 class="text-xl font-bold text-amber-500 flex items-center gap-3">
                <x-heroicon-o-envelope class="w-6 h-6" />
                Send us a Message
            </h3>
            <p class="text-sm text-gray-400 mt-2">Fill out the form below and we'll get back to you shortly</p>
        </div>

        <form wire:submit="submit" class="space-y-5">
            <div class="grid md:grid-cols-2 gap-5">
                <x-atoms.input
                    type="text"
                    wire:model="name"
                    label="Your Name *"
                    placeholder="John Doe"
                    variant="outline"
                    :error="$errors->first('name')"
                    required
                />

                <x-atoms.input
                    type="email"
                    wire:model="email"
                    label="Your Email *"
                    placeholder="john@example.com"
                    variant="outline"
                    :error="$errors->first('email')"
                    required
                />
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                <x-atoms.input
                    type="text"
                    wire:model="phone"
                    label="Your Phone"
                    placeholder="+62 812 3456 7890"
                    variant="outline"
                    :error="$errors->first('phone')"
                />

                <x-atoms.input
                    type="text"
                    wire:model="subject"
                    label="Subject *"
                    placeholder="What is this about?"
                    variant="outline"
                    :error="$errors->first('subject')"
                    required
                />
            </div>

            <x-atoms.textarea
                wire:model="message"
                label="Your Message *"
                placeholder="Tell us more about your inquiry..."
                rows="5"
                variant="outline"
                :error="$errors->first('message')"
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
                    <span wire:loading.remove>Send Message</span>
                    <span wire:loading>Sending...</span>
                </x-atoms.button>
            </div>
        </form>
    </div>
</div>
