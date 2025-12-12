<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - PT. Tropis Fish Indonesia' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 font-poppins">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r border-gray-200 fixed h-full">
            <div class="p-6">
                <div class="flex items-center gap-2 mb-8">
                    <x-atoms.logo size="lg" />
                    <div>
                        <h1 class="text-sm font-bold text-blue-600 text-transparent bg-clip-text">PT. Tropis Fish</h1>
                        <p class="text-xs text-gray-500">Admin Panel</p>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                        <x-heroicon-o-home class="w-5 h-5" />
                        Dashboard
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition">
                        <x-heroicon-o-cube class="w-5 h-5" />
                        Produk
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition">
                        <x-heroicon-o-rectangle-stack class="w-5 h-5" />
                        Kategori
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition">
                        <x-heroicon-o-photo class="w-5 h-5" />
                        Galeri
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition">
                        <x-heroicon-o-chat-bubble-left-right class="w-5 h-5" />
                        Pesan
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition">
                        <x-heroicon-o-cog-6-tooth class="w-5 h-5" />
                        Pengaturan
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="ml-64 flex-1">
            {{-- Top Bar --}}
            <header class="bg-white border-b border-gray-200 sticky top-0 z-40">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('home') }}" target="_blank" class="text-gray-600 hover:text-blue-600 transition">
                            <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5" />
                        </a>

                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-700">{{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-orange-600 rounded-full flex items-center justify-center text-white font-bold">
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
</body>
</html>
