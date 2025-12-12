<nav id="desktop-nav" class="hidden md:block fixed top-0 z-50 backdrop-blur-md max-w-7xl mx-auto left-0 right-0 px-6 transition-all duration-300">
    <div class="flex items-center justify-between h-16 w-full">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <x-atoms.logo class="h-10" />
            <span id="nav-brand" class="font-bold text-xl transition-colors duration-300 text-white">PT. Tropis Fish Indonesia</span>
        </a>

        <div class="flex gap-6">
            <a href="{{ route('home') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Home</a>
            <a href="{{ route('company-profile') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Company Profile</a>
            <a href="{{ route('stock-list') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Stock List</a>
            <a href="{{ route('gallery') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Gallery</a>
            <a href="{{ route('terms') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Terms & Condition</a>
            <a href="{{ route('contact') }}" class="nav-link transition-colors duration-300 text-white hover:text-amber-300">Contact Us</a>
        </div>
    </div>
</nav>

<nav class="md:hidden fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
    <div class="flex items-center justify-between h-16 px-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <x-atoms.logo class="h-10" />
            <span class="font-bold text-lg text-primary-900">PT. Tropis Fish Indonesia</span>
        </a>

        <button id="mobile-menu-button" class="p-2 hover:bg-gray-100 rounded-lg transition">
            <x-heroicon-o-bars-3 class="w-6 h-6" id="menu-icon" />
            <x-heroicon-o-x-mark class="w-6 h-6 hidden" id="close-icon" />
        </button>
    </div>

    <div id="mobile-overlay" class="hidden fixed inset-0 bg-black/50 z-40 transition-opacity duration-200"></div>

    <div id="mobile-menu" class="hidden fixed top-0 right-0 bottom-0 w-80 bg-white shadow-xl z-50 overflow-y-auto transition-transform duration-300 transform translate-x-full">
        <div class="p-6 space-y-3">
            <x-atoms.button variant="outline" size="md" :href="route('home')" class="w-full">
                Home
            </x-atoms.button>
            <x-atoms.button variant="outline" size="md" :href="route('company-profile')" class="w-full">
                Company Profile
            </x-atoms.button>
            <x-atoms.button variant="outline" size="md" :href="route('stock-list')" class="w-full">
                Stock List
            </x-atoms.button>
            <x-atoms.button variant="outline" size="md" :href="route('gallery')" class="w-full">
                Gallery
            </x-atoms.button>
            <x-atoms.button variant="outline" size="md" :href="route('terms')" class="w-full">
                Terms & Condition
            </x-atoms.button>
            <x-atoms.button variant="outline" size="md" :href="route('contact')" class="w-full">
                Contact Us
            </x-atoms.button>
        </div>
    </div>
</nav>

<style>
    #mobile-menu.show {
        display: block !important;
        transform: translateX(0) !important;
    }

    #mobile-overlay.show {
        display: block !important;
        opacity: 1 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop navbar scroll animation
        const desktopNav = document.getElementById('desktop-nav');
        const navBrand = document.getElementById('nav-brand');
        const navLinks = document.querySelectorAll('.nav-link');
        let scrolled = false;

        function handleScroll() {
            const isScrolled = window.scrollY > 10;

            if (isScrolled !== scrolled) {
                scrolled = isScrolled;

                if (scrolled) {
                    desktopNav.style.borderRadius = '9999px';
                    desktopNav.style.marginTop = '1rem';
                    desktopNav.style.marginBottom = '1rem';
                    desktopNav.style.backgroundColor = 'rgba(255, 255, 255, 1)';
                    desktopNav.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';

                    // Change brand text color to dark
                    navBrand.classList.remove('text-white');
                    navBrand.classList.add('text-gray-800');

                    // Change link text colors to dark
                    navLinks.forEach(link => {
                        link.classList.remove('text-white', 'hover:text-primary-300');
                        link.classList.add('text-gray-900', 'hover:text-primary-800');
                    });
                } else {
                    desktopNav.style.borderRadius = '0px';
                    desktopNav.style.marginTop = '0rem';
                    desktopNav.style.marginBottom = '0rem';
                    desktopNav.style.backgroundColor = 'rgba(255, 255, 255, 0)';
                    desktopNav.style.boxShadow = '';

                    // Change brand text color to white
                    navBrand.classList.remove('text-gray-800');
                    navBrand.classList.add('text-white');

                    // Change link text colors to white
                    navLinks.forEach(link => {
                        link.classList.remove('text-gray-900', 'hover:text-primary-800');
                        link.classList.add('text-white', 'hover:text-primary-300');
                    });
                }
            }
        }

        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Initial check

        // Mobile menu
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-overlay');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        function openMobileMenu() {
            mobileMenu.classList.remove('hidden');
            overlay.classList.remove('hidden');
            // Force reflow
            mobileMenu.offsetHeight;
            mobileMenu.classList.add('show');
            overlay.classList.add('show');
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('show');
            overlay.classList.remove('show');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
                overlay.classList.add('hidden');
            }, 300);
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.style.overflow = 'unset';
        }

        menuButton.addEventListener('click', function() {
            if (mobileMenu.classList.contains('show')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        overlay.addEventListener('click', closeMobileMenu);

        // Close mobile menu on button/link click
        const mobileLinks = mobileMenu.querySelectorAll('a, button');
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
    });
</script>
