<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $companyLogo = App\Models\Setting::get('company_logo');
        $faviconUrl = $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg');
    @endphp
    <title>{{ $title ?? 'Dashboard - PT. Tropis Fish Indonesia' }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ $faviconUrl }}">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased bg-gray-900 font-poppins" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">
        {{-- Mobile Overlay --}}
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm z-40 lg:hidden"
            style="display: none;"
        ></div>

        {{-- Sidebar --}}
        <aside
            x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="w-64 bg-gray-800 border-r border-gray-700 fixed h-full z-50 transition-transform duration-300 ease-in-out flex flex-col"
        >
            {{-- Header - Fixed --}}
            <div class="p-4 sm:p-6 flex-shrink-0">
                {{-- Mobile Close Button --}}
                <button
                    @click="sidebarOpen = false"
                    class="lg:hidden absolute top-4 right-4 text-gray-400 hover:text-white transition z-10"
                >
                    <x-heroicon-o-x-mark class="w-6 h-6" />
                </button>

                <div class="flex items-center gap-3">
                    @php
                        $companyLogo = App\Models\Setting::get('company_logo');
                        $companyName = App\Models\Setting::get('company_name', 'PT. Tropis Fish Indonesia');
                    @endphp
                    <img src="{{ $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg') }}" alt="Logo" class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                    <div class="min-w-0">
                        <h1 class="text-sm font-stencil font-bold text-white truncate">PT. TROPIS FISH</h1>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </div>
            </div>

            {{-- Navigation - Scrollable --}}
            <nav class="flex-1 overflow-y-auto px-4 sm:px-6 pb-4 space-y-1 sm:space-y-2 scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-home class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Dashboard</span>
                </a>

                <a href="{{ route('admin.heroes') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.heroes') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-rectangle-stack class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Hero Slider</span>
                </a>

                <a href="{{ route('admin.stock-lists') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.stock-lists') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-clipboard-document-list class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Stock List</span>
                </a>

                <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.categories') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-tag class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Categories</span>
                </a>

                <a href="{{ route('admin.galleries') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.galleries') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-photo class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Gallery</span>
                </a>

                <a href="{{ route('admin.stats') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.stats') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-chart-bar class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Stats</span>
                </a>

                <a href="{{ route('admin.about-sections') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.about-sections') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-information-circle class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">About Sections</span>
                </a>

                <a href="{{ route('admin.company-sections') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.company-sections') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-building-office class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Company Profile</span>
                </a>

                <a href="{{ route('admin.footer-sections') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.footer-sections') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-square-3-stack-3d class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Footer Sections</span>
                </a>

                <a href="{{ route('admin.terms') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.terms') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-document-text class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Terms & Conditions</span>
                </a>

                <div class="border-t border-gray-700 my-3 sm:my-4"></div>

                <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.profile') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-user class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Profile</span>
                </a>

                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition {{ request()->routeIs('admin.settings') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                    <x-heroicon-o-cog-6-tooth class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Settings</span>
                </a>
            </nav>

            {{-- Footer Actions - Fixed --}}
            <div class="flex-shrink-0 border-t border-gray-700 px-4 sm:px-6 py-3 sm:py-4 space-y-1">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 text-gray-300 hover:bg-gray-700 rounded-lg transition">
                    <x-heroicon-o-globe-alt class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">View Website</span>
                </a>

                <a href="{{ route('admin.logout') }}" class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 text-red-400 hover:bg-gray-700 rounded-lg transition">
                    <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5 flex-shrink-0" />
                    <span class="truncate">Logout</span>
                </a>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="lg:ml-64 flex-1 min-w-0">
            {{-- Top Bar --}}
            <header class="bg-gray-800 border-b border-gray-700 sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 sm:px-6 py-3 sm:py-4 gap-4">
                    <div class="flex items-center gap-3 min-w-0 flex-1">
                        {{-- Mobile Hamburger Button --}}
                        <button
                            @click="sidebarOpen = true"
                            class="lg:hidden text-gray-400 hover:text-white transition flex-shrink-0"
                        >
                            <x-heroicon-o-bars-3 class="w-6 h-6" />
                        </button>

                        <h2 class="text-xl sm:text-2xl font-bold text-white truncate">{{ $heading ?? 'Dashboard' }}</h2>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                        <div class="hidden sm:flex items-center gap-3">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-white">{{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-xs text-gray-400">Administrator</p>
                            </div>
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-amber-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                            </div>
                        </div>
                        {{-- Mobile Avatar Only --}}
                        <div class="sm:hidden w-8 h-8 bg-gradient-to-br from-blue-600 to-amber-600 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                            {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-4 sm:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
