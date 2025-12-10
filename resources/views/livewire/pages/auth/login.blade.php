<div class="min-h-screen bg-gradient-to-br from-blue-50 to-orange-50 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        {{-- Logo and Header --}}
        <div class="text-center">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <x-atoms.logo size="lg" class="!text-white" />
                </div>
            </div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-orange-600 dark:from-blue-400 dark:to-orange-400 text-transparent bg-clip-text">
                Admin Login
            </h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">
                Masuk ke dashboard admin PT. Tropis Fish Indonesia
            </p>
        </div>

        {{-- Login Form --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-8 border border-gray-200 dark:border-gray-700">
            <form wire:submit="login" class="space-y-6">
                {{-- Error Message --}}
                @if (session('error'))
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Email Input --}}
                <div>
                    <x-atoms.input
                        type="email"
                        label="Email"
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
                        placeholder="••••••••"
                        required
                        :error="$errors->first('password')"
                    />
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            id="remember"
                            type="checkbox"
                            wire:model="remember"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                            Ingat saya
                        </label>
                    </div>

                    <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        Lupa password?
                    </a>
                </div>

                {{-- Submit Button --}}
                <div>
                    <x-atoms.button
                        type="submit"
                        variant="primary"
                        class="w-full"
                    >
                        <span wire:loading.remove>Masuk</span>
                        <span wire:loading>Memproses...</span>
                    </x-atoms.button>
                </div>

                {{-- Back to Home --}}
                <div class="text-center">
                    <a href="{{ route('home') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>

        {{-- Additional Info --}}
        <div class="text-center text-sm text-gray-600 dark:text-gray-400">
            <p>&copy; {{ date('Y') }} PT. Tropis Fish Indonesia. All rights reserved.</p>
        </div>
    </div>
</div>
