<header class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <x-atoms.logo />
                <span class="text-xl font-bold text-gray-900">PT. Tropis Fish Indonesia</span>
            </a>

            <div class="hidden lg:flex items-center gap-6">
                <x-molecules.nav-link href="{{ route('home') }}">Home</x-molecules.nav-link>
                <x-molecules.nav-link href="{{ route('company-profile') }}">Company Profile</x-molecules.nav-link>
                <x-molecules.nav-link href="{{ route('stock-list') }}">Stock List</x-molecules.nav-link>
                <x-molecules.nav-link href="{{ route('gallery') }}">Gallery</x-molecules.nav-link>
                <x-molecules.nav-link href="{{ route('terms') }}">Terms & Condition</x-molecules.nav-link>
                <x-molecules.nav-link href="{{ route('contact') }}">Contact Us</x-molecules.nav-link>
            </div>

            <div class="flex items-center gap-4">
                <button class="lg:hidden text-gray-900">
                    <x-atoms.icon name="menu" />
                </button>
            </div>
        </div>
    </nav>
</header>
