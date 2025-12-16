<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - PT. Tropis Fish Indonesia' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased bg-gray-900 font-poppins">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 border-r border-gray-700 fixed h-full">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-8">
                    @php
                        $companyLogo = App\Models\Setting::get('company_logo');
                        $companyName = App\Models\Setting::get('company_name', 'PT. Tropis Fish Indonesia');
                    @endphp
                    <img src="{{ $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg') }}" alt="Logo" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <h1 class="text-sm font-bold text-white">{{ $companyName }}</h1>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                        <x-heroicon-o-home class="w-5 h-5" />
                        Dashboard
                    </a>

                    <a href="{{ route('admin.heroes') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.heroes') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                        <x-heroicon-o-rectangle-stack class="w-5 h-5" />
                        Hero Slider
                    </a>

                    <a href="{{ route('admin.stock-lists') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.stock-lists') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                        <x-heroicon-o-clipboard-document-list class="w-5 h-5" />
                        Stock List
                    </a>

                    <a href="{{ route('admin.galleries') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.galleries') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                        <x-heroicon-o-photo class="w-5 h-5" />
                        Gallery
                    </a>

                    <a href="{{ route('admin.stats') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.stats') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                        <x-heroicon-o-chart-bar class="w-5 h-5" />
                        Stats
                    </a>

                    <div class="border-t border-gray-700 my-4"></div>

                    <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.settings') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-300 hover:bg-gray-700' }}">
                        <x-heroicon-o-cog-6-tooth class="w-5 h-5" />
                        Settings
                    </a>

                    <div class="border-t border-gray-700 mt-4 pt-4">
                        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-lg transition">
                            <x-heroicon-o-globe-alt class="w-5 h-5" />
                            View Website
                        </a>

                        <a href="{{ route('admin.logout') }}" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-gray-700 rounded-lg transition">
                            <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                            Logout
                        </a>
                    </div>
                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="ml-64 flex-1">
            {{-- Top Bar --}}
            <header class="bg-gray-800 border-b border-gray-700 sticky top-0 z-40">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">{{ $heading ?? 'Dashboard' }}</h2>

                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-white">{{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-xs text-gray-400">Administrator</p>
                            </div>
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-amber-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
