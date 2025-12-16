@php
    $companyLogo = App\Models\Setting::get('company_logo');
    $companyName = App\Models\Setting::get('company_name', 'PT. Tropis Fish Indonesia');
@endphp

<nav id="desktop-nav" class="hidden md:block fixed top-0 z-40 backdrop-blur-md bg-transparent max-w-7xl mx-auto left-0 right-0 px-6 transition-all duration-300">
    <div class="flex items-center justify-between h-18 w-full">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg') }}" alt="{{ $companyName }}" class="h-12 w-12 object-cover rounded-full border-2 border-amber-400">
            <span id="nav-brand" class="font-bold text-xl transition-colors duration-300 text-white">{{ $companyName }}</span>
        </a>

        <div class="flex gap-6">
            <a href="{{ route('company-profile') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Company Profile</a>
            <a href="{{ route('stock-list') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Stock List</a>
            <a href="{{ route('gallery') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Gallery</a>
            <a href="{{ route('terms') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Terms</a>
        </div>
    </div>
</nav>

<nav id="mobile-nav" class="md:hidden fixed top-0 left-0 right-0 z-40 backdrop-blur-md transition-all duration-300">
    <div class="flex items-center justify-between h-15 px-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg') }}" alt="{{ $companyName }}" class="h-10 w-10 object-cover rounded-full border-2 border-amber-400">
            <span id="mobile-brand" class="font-bold text-base text-white transition-colors duration-300">{{ Str::limit($companyName, 20) }}</span>
        </a>

        <button id="mobile-menu-button" class="p-2 rounded-lg transition text-white hover:bg-white/10 z-[80]">
            <x-heroicon-o-bars-3 id="menu-icon" class="w-6 h-6" />
            <x-heroicon-o-x-mark id="close-icon" class="w-6 h-6 hidden" />
        </button>
    </div>
</nav>

<!-- Mobile Dropdown Menu -->
<div id="mobile-menu" class="md:hidden fixed left-0 right-0 bg-amber-500 shadow-xl z-40 overflow-hidden transition-all duration-300 max-h-0 opacity-0" style="top: 56px;">
    <div class="px-4 py-2">
        <div class="space-y-1">
            <a href="{{ route('company-profile') }}" class="mobile-link block px-4 py-3 text-white hover:bg-white/20 hover:text-amber-100 rounded-lg transition-all duration-200">
                Company Profile
            </a>
            <a href="{{ route('stock-list') }}" class="mobile-link block px-4 py-3 text-white hover:bg-white/20 hover:text-amber-100 rounded-lg transition-all duration-200">
                Stock List
            </a>
            <a href="{{ route('gallery') }}" class="mobile-link block px-4 py-3 text-white hover:bg-white/20 hover:text-amber-100 rounded-lg transition-all duration-200">
                Gallery
            </a>
            <a href="{{ route('terms') }}" class="mobile-link block px-4 py-3 text-white hover:bg-white/20 hover:text-amber-100 rounded-lg transition-all duration-200">
                Terms
            </a>
        </div>
    </div>
</div>

<style>
    #mobile-menu.active {
        max-height: 500px;
        opacity: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop navbar scroll animation
        const desktopNav = document.getElementById('desktop-nav');
        const navBrand = document.getElementById('nav-brand');
        const navLinks = document.querySelectorAll('.nav-link');

        // Mobile navbar scroll animation
        const mobileNav = document.getElementById('mobile-nav');
        const mobileBrand = document.getElementById('mobile-brand');
        const menuButton = document.getElementById('mobile-menu-button');

        let scrolled = false;

        function handleScroll() {
            const isScrolled = window.scrollY > 10;

            if (isScrolled !== scrolled) {
                scrolled = isScrolled;

                if (scrolled) {
                    // Desktop
                    desktopNav.style.borderRadius = '9999px';
                    desktopNav.style.marginTop = '1rem';
                    desktopNav.style.marginBottom = '1rem';
                    desktopNav.style.backgroundColor = 'rgba(245, 158, 11, 0.95)';
                    desktopNav.style.boxShadow = '0 4px 20px rgba(245, 158, 11, 0.3)';

                    navBrand.classList.remove('text-gray-800');
                    navBrand.classList.add('text-white');

                    navLinks.forEach(link => {
                        link.classList.remove('text-gray-900', 'hover:text-amber-600');
                        link.classList.add('text-white', 'hover:text-amber-100');
                    });

                    // Mobile
                    mobileNav.style.backgroundColor = 'rgba(245, 158, 11, 0.95)';
                    mobileNav.style.boxShadow = '0 2px 10px rgba(245, 158, 11, 0.3)';

                    mobileBrand.classList.remove('text-gray-800');
                    mobileBrand.classList.add('text-white');

                    menuButton.classList.remove('text-gray-800', 'hover:bg-gray-100');
                    menuButton.classList.add('text-white', 'hover:bg-white/20');
                } else {
                    // Desktop
                    desktopNav.style.borderRadius = '0px';
                    desktopNav.style.marginTop = '0rem';
                    desktopNav.style.marginBottom = '0rem';
                    desktopNav.style.backgroundColor = 'rgba(255, 255, 255, 0)';
                    desktopNav.style.boxShadow = '';

                    navBrand.classList.remove('text-amber-500');
                    navBrand.classList.add('text-white');

                    navLinks.forEach(link => {
                        link.classList.remove('text-amber-100', 'hover:text-amber-100');
                        link.classList.add('text-white', 'hover:text-amber-300');
                    });

                    // Mobile
                    mobileNav.style.backgroundColor = 'rgba(255, 255, 255, 0)';
                    mobileNav.style.boxShadow = '';

                    mobileBrand.classList.remove('text-amber-500');
                    mobileBrand.classList.add('text-white');

                    menuButton.classList.remove('text-amber-500', 'hover:bg-white/20');
                    menuButton.classList.add('text-white', 'hover:bg-white/10');
                }
            }
        }

        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Initial check

        // Mobile menu dropdown
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        function toggleMobileMenu() {
            const isActive = mobileMenu.classList.contains('active');

            if (isActive) {
                mobileMenu.classList.remove('active');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            } else {
                mobileMenu.classList.add('active');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            }
        }

        if (menuButton) {
            menuButton.addEventListener('click', toggleMobileMenu);
        }

        // Close mobile menu on link click
        const mobileLinks = document.querySelectorAll('.mobile-link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            });
        });
    });
</script>
