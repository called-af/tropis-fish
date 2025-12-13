<div class="h-screen flex overflow-hidden">
    {{-- Left Side - Image Section --}}
    <div class="hidden lg:flex lg:w-1/2 xl:w-3/5 relative bg-gradient-to-br from-blue-900/70 via-blue-800/60 to-black/80 overflow-hidden">
        {{-- Background Image --}}
        <div class="absolute inset-0">
            <img
                src="{{ asset('assets/archer-fish-brackish.jpg') }}"
                alt="Archer Fish - PT. Tropis Fish Indonesia"
                class="w-full h-full object-cover opacity-80"
            />
        </div>

        {{-- Overlay Gradient untuk meningkatkan kontras --}}
        <div class="absolute inset-0 bg-gradient-to-br from-blue-800/40 via-blue-900/30 to-blue-950/20"></div>

        {{-- Content --}}
        <div class="relative z-10 flex flex-col justify-between p-12 xl:p-16 w-full">
            {{-- Logo & Brand --}}
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-2xl overflow-hidden">
                        <img
                            src="{{ asset('assets/logo-pt.jpeg') }}"
                            alt="PT. Tropis Fish Indonesia Logo"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-amber-400">PT. Tropis Fish Indonesia</h1>
                        <p class="text-sm text-amber-300 font-light">Premium Ornamental Fish Supplier</p>
                    </div>
                </div>
            </div>

            {{-- Center Message --}}
            <div class="flex-1 flex items-center">
                <div class="max-w-lg">
                    <h2 class="text-5xl xl:text-6xl font-extrabold text-amber-400 mb-6 leading-tight tracking-tight">
                        Welcome to Admin Portal
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-amber-500 to-transparent mb-6"></div>

                    {{-- Features --}}
                    <div class="mt-12 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <x-heroicon-o-check class="w-6 h-6 text-amber-400" />
                            </div>
                            <span class="text-amber-300 font-light">Real-time inventory management</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <x-heroicon-o-check class="w-6 h-6 text-amber-400" />
                            </div>
                            <span class="text-amber-300 font-light">Advanced analytics & reporting</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <x-heroicon-o-check class="w-6 h-6 text-amber-400" />
                            </div>
                            <span class="text-amber-300 font-light">Secure & reliable platform</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="text-sm text-amber-300 font-light">
                <p>&copy; {{ date('Y') }} PT. Tropis Fish Indonesia. All rights reserved.</p>
            </div>
        </div>
    </div>

    {{-- Right Side - Login Form --}}
    <div class="w-full lg:w-1/2 xl:w-2/5 bg-gray-900 flex items-center justify-center p-6 sm:p-8 lg:p-12">
        <div class="w-full max-w-md">
            {{-- Mobile Logo --}}
            <div class="lg:hidden text-center mb-10">
                <div class="flex justify-center mb-4">
                    <div class="w-20 h-20 bg-gray-900 rounded-2xl flex items-center justify-center shadow-2xl overflow-hidden">
                        <img
                            src="{{ asset('assets/logo-pt.jpeg') }}"
                            alt="PT. Tropis Fish Indonesia Logo"
                            class="w-full h-full object-cover"
                        />
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white">PT. Tropis Fish Indonesia</h1>
            </div>

                {{-- Form Header --}}
                <div class="text-center mb-8">
                    <h2 class="text-3xl lg:text-4xl font-light text-white mb-3 tracking-tight">Admin Login</h2>
                    <div class="w-16 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mb-3"></div>
                    <p class="text-gray-400 font-light">Sign in to access your dashboard</p>
                </div>

                <form wire:submit="login" class="space-y-6">
                    {{-- Error Message --}}
                    @if (session('error'))
                        <div class="bg-red-500/20 border border-red-500/50 text-red-200 px-4 py-3 rounded-2xl font-light tracking-wide text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Email Input --}}
                    <div>
                        <x-atoms.input
                            type="email"
                            label="Email Address"
                            wire:model="email"
                            placeholder="admin@tropisfish.com"
                            required
                            :error="$errors->first('email')"
                        />
                    </div>

                    {{-- Password Input --}}
                    <div>
                        <x-atoms.input
                            type="password"
                            label="Password"
                            wire:model="password"
                            placeholder="Enter your password"
                            required
                            :error="$errors->first('password')"
                        />
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-2">
                        <x-atoms.button
                            type="submit"
                            variant="primary"
                            size="lg"
                            icon="arrow-right-on-rectangle"
                            class="w-full shadow-xl shadow-blue-900/50"
                            wire:loading.attr="disabled"
                        >
                            <span wire:loading.remove>Sign In</span>
                            <span wire:loading>Processing...</span>
                        </x-atoms.button>
                    </div>

                    {{-- Back to Home --}}
                    <div class="text-center pt-4">
                        <a href="{{ route('home') }}" class="text-sm text-amber-400 hover:text-amber-300 font-light tracking-wide transition-colors duration-300 inline-flex items-center gap-2">
                            <x-heroicon-o-arrow-left class="w-4 h-4" />
                            Back to Home
                        </a>
                    </div>
                </form>
            </div>
    </div>
</div>
