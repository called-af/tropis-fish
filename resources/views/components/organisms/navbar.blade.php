@php
    $companyLogo = App\Models\Setting::get('company_logo');
    $companyName = App\Models\Setting::get('company_name', 'PT. Tropis Fish Indonesia');
    $companyDesc = App\Models\Setting::get('company_description', 'Export of Ornamental Freshwater Fish');
    
    $categories = Illuminate\Support\Facades\Cache::remember('navbar_categories', 3600, function() {
        return App\Models\Category::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    });
@endphp

<nav id="desktop-nav"
    class="hidden md:block fixed top-0 z-40 backdrop-blur-md bg-transparent max-w-7xl mx-auto left-0 right-0 px-6 transition-all duration-500 ease-out"
    x-data="{ scrolled: false }" x-init="
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 10;
        });
    ">
    <div class="flex items-center justify-between h-18 w-full">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg') }}"
                alt="{{ $companyName }}" class="h-12 w-12 object-cover rounded-full border-2 border-amber-400">
            <div class="flex flex-col gap-0.5">
                <span id="nav-brand" class="font-stencil font-bold text-xl text-white leading-tight">
                    {{ $companyName }}
                </span>

                <div class="relative w-full flex justify-center">
                    <span
                        class="block h-[2px] w-52 bg-gradient-to-r from-transparent via-white to-transparent opacity-80"></span>
                </div>

                <span class="text-sm text-white font-medium">
                    {{ $companyDesc }}
                </span>
            </div>
        </a>

        <div class="flex gap-6">
            <a href="{{ route('home') }}#company-profile"
                class="nav-link company-profile-link transition-colors duration-300 text-white hover:text-amber-500">
                Company Profile
            </a>

            <a href="{{ route('home') }}#stock-list"
                class="nav-link stock-list-link transition-colors duration-300 text-white hover:text-amber-500">
                Stock List
            </a>

            {{-- Freshwater Fish Dropdown --}}
            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a href="{{ route('categories') }}"
                    class="nav-link transition-colors duration-300 text-white hover:text-amber-500 flex items-center gap-1">
                    Freshwater Fish
                    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                
                {{-- Dropdown Menu --}}
                <div x-show="open"
                    x-transition:enter="transition ease-out duration-205"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute right-0 mt-1 w-[600px] rounded-xl bg-gray-900 border border-gray-700 shadow-2xl p-4 z-50 backdrop-blur-md bg-opacity-95"
                    style="display: none;"
                >
                    <div class="grid grid-cols-3 gap-2">
                        <div class="col-span-3 pb-2 border-b border-gray-800 flex justify-between items-center">
                            <a href="{{ route('categories') }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-bold text-amber-500 hover:text-white hover:bg-amber-500/10 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                All Categories
                            </a>
                            <span class="text-xs text-gray-500 font-semibold px-3">Fish Categories</span>
                        </div>
                        @if($categories->count() > 0)
                            @foreach($categories as $cat)
                                <a href="{{ route('category.detail', $cat->slug) }}" class="flex items-center px-3 py-2 text-xs font-semibold text-gray-300 hover:text-amber-500 hover:bg-gray-800/50 rounded-lg transition-all duration-200 truncate">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500/40 mr-2 shrink-0"></span>
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        @else
                            <div class="col-span-3 text-center py-4 text-xs text-gray-500">
                                No active categories found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{ route('home') }}#gallery"
                class="nav-link gallery-link transition-colors duration-300 text-white hover:text-amber-500">
                Gallery
            </a>
            <a href="#" @click.prevent="$dispatch('open-terms-modal')"
                class="nav-link transition-colors duration-300 text-white hover:text-amber-500">
                Terms
            </a>
            <a href="{{ route('home') }}#contact"
                class="nav-link contact-link transition-colors duration-300 text-white hover:text-amber-500">
                Contact Us
            </a>
        </div>
    </div>
</nav>

<nav id="mobile-nav"
    class="md:hidden fixed top-0 left-0 right-0 z-40 w-full backdrop-blur-md transition-all duration-500 ease-out">
    <div class="flex items-center justify-between h-15 px-4 w-full">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg') }}"
                alt="{{ $companyName }}" class="h-10 w-10 object-cover rounded-full border-2 border-amber-400">
            <div class="flex flex-col gap-0.5 items-center sm:hidden">
                <span id="mobile-brand" class="font-stencil font-bold text-base text-white leading-tight text-center">
                    {{ $companyName }}
                </span>

                <!-- GARIS PEMISAH MOBILE -->
                <span class="block h-[2px] w-43 bg-gradient-to-r from-transparent via-white to-transparent opacity-90">
                </span>

                <span class="text-xs text-white font-medium text-center">
                    {{ $companyDesc }}
                </span>
            </div>

        </a>

        <button id="mobile-menu-button" class="p-2 rounded-lg transition-all duration-300 text-white z-[80]">
            <x-heroicon-o-bars-3 id="menu-icon" class="w-6 h-6" />
            <x-heroicon-o-x-mark id="close-icon" class="w-6 h-6 hidden" />
        </button>
    </div>
</nav>

<!-- Mobile Dropdown Menu -->
<div id="mobile-menu"
    class="md:hidden fixed left-0 right-0 w-full bg-amber-500 shadow-xl z-40 overflow-hidden transition-all duration-500 ease-out max-h-0 opacity-0"
    style="top: 56px;">
    <div class="px-4 py-2 w-full">
        <div class="space-y-1">
            <a href="{{ route('home') }}#company-profile"
                class="mobile-link company-profile-link block px-4 py-3 text-white hover:bg-amber-600 rounded-lg transition-all duration-300">
                Company Profile
            </a>

            <a href="{{ route('home') }}#stock-list"
                class="mobile-link stock-list-link block px-4 py-3 text-white hover:bg-amber-600 rounded-lg transition-all duration-300">
                Stock List
            </a>

            {{-- Mobile Freshwater Fish Accordion --}}
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left block px-4 py-3 text-white hover:bg-amber-600 rounded-lg transition-all duration-300 flex items-center justify-between">
                    <span>Freshwater Fish</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="p-2 bg-amber-600/30 rounded-lg mt-1 max-h-64 overflow-y-auto scrollbar-thin scrollbar-thumb-amber-700/50">
                    <div class="grid grid-cols-2 gap-1">
                        <a href="{{ route('categories') }}"
                            class="mobile-link col-span-2 block px-4 py-2 text-sm text-amber-250 font-bold hover:bg-amber-700/40 rounded-md transition-all duration-300 border-b border-amber-600/20">
                            All Categories
                        </a>
                        @if($categories->count() > 0)
                            @foreach($categories as $cat)
                                <a href="{{ route('category.detail', $cat->slug) }}"
                                    class="mobile-link block px-3 py-2 text-xs text-white hover:bg-amber-700/40 rounded-md transition-all duration-300 truncate">
                                    • {{ $cat->name }}
                                </a>
                            @endforeach
                        @else
                            <div class="col-span-2 text-center py-2 text-xs text-amber-200">No active categories.</div>
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{ route('home') }}#gallery"
                class="mobile-link gallery-link block px-4 py-3 text-white hover:bg-amber-600 rounded-lg transition-all duration-300">
                Gallery
            </a>
            <a href="#" @click.prevent="$dispatch('open-terms-modal')"
                class="mobile-link block px-4 py-3 text-white hover:bg-amber-600 rounded-lg transition-all duration-300">
                Terms
            </a>
            <a href="{{ route('home') }}#contact"
                class="mobile-link contact-link block px-4 py-3 text-white hover:bg-amber-600 rounded-lg transition-all duration-300">
                Contact Us
            </a>
        </div>
    </div>
</div>

<style>
    #mobile-menu.active {
        max-height: 90vh;
        overflow-y: auto;
        opacity: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
                    desktopNav.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
                    desktopNav.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';

                    navBrand.classList.remove('text-gray-800');
                    navBrand.classList.add('text-white');

                    navLinks.forEach(link => {
                        link.classList.remove('text-gray-900', 'hover:text-amber-600');
                        link.classList.add('text-white', 'hover:text-amber-400');
                    });

                    // Mobile
                    mobileNav.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
                    mobileNav.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';

                    if (mobileBrand) {
                        mobileBrand.classList.remove('text-gray-800');
                        mobileBrand.classList.add('text-white');
                    }

                    menuButton.classList.remove('text-gray-800', 'hover:bg-gray-100');
                    menuButton.classList.add('text-white', 'hover:bg-white/20');
                } else {
                    // Desktop
                    desktopNav.style.borderRadius = '0px';
                    desktopNav.style.marginTop = '0rem';
                    desktopNav.style.marginBottom = '0rem';
                    desktopNav.style.backgroundColor = 'transparent';
                    desktopNav.style.boxShadow = '';

                    navBrand.classList.remove('text-amber-500');
                    navBrand.classList.add('text-white');

                    navLinks.forEach(link => {
                        link.classList.remove('text-white', 'hover:text-amber-400');
                        link.classList.add('text-white', 'hover:text-amber-500');
                    });

                    // Mobile
                    mobileNav.style.backgroundColor = 'transparent';
                    mobileNav.style.boxShadow = '';

                    if (mobileBrand) {
                        mobileBrand.classList.remove('text-amber-500');
                        mobileBrand.classList.add('text-white');
                    }

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
            link.addEventListener('click', function () {
                mobileMenu.classList.remove('active');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            });
        });

        // Smooth scroll for anchor links (Contact, Company Profile, Gallery)
        function smoothScrollToSection(targetId) {
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                // Get navbar height for offset
                const navbarHeight = desktopNav ? desktopNav.offsetHeight : 80;
                const offset = 20; // Additional padding

                // Calculate position
                const targetPosition = targetSection.getBoundingClientRect().top + window.pageYOffset;
                const offsetPosition = targetPosition - navbarHeight - offset;

                // Smooth scroll with animation
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobile-menu');
                if (mobileMenu && mobileMenu.classList.contains('active')) {
                    toggleMobileMenu();
                }
            }
        }

        function setupSmoothScroll(selector, targetId) {
            const links = document.querySelectorAll(selector);
            links.forEach(link => {
                link.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');

                    // Check if link contains the target ID
                    if (href && href.includes(targetId)) {
                        e.preventDefault();

                        // Check current page
                        const currentPath = window.location.pathname;
                        const isHomePage = currentPath === '/' || currentPath === '';

                        // If we're not on the home page, navigate first
                        if (!isHomePage && !href.startsWith('#')) {
                            window.location.href = href;
                        } else {
                            // If already on home page, just scroll
                            smoothScrollToSection(targetId);
                        }
                    }
                });
            });
        }

        // Setup smooth scroll for all anchor links
        setupSmoothScroll('.contact-link', '#contact');
        setupSmoothScroll('.company-profile-link', '#company-profile');
        setupSmoothScroll('.stock-list-link', '#stock-list');
        setupSmoothScroll('.gallery-link', '#gallery');

        // Handle hash in URL on page load (for when user comes from another page)
        window.addEventListener('load', function () {
            const hash = window.location.hash;
            if (hash) {
                // Small delay to ensure page is fully loaded
                setTimeout(() => {
                    smoothScrollToSection(hash);
                }, 100);
            }
        });

        // Also handle hash changes
        window.addEventListener('hashchange', function () {
            const hash = window.location.hash;
            if (hash) {
                smoothScrollToSection(hash);
            }
        });
    });
</script>