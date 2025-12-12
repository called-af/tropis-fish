<div>
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Products --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-cube class="w-6 h-6 text-white" />
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+12%</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Total Products</h3>
            <p class="text-3xl font-bold text-gray-800">248</p>
        </div>

        {{-- Total Categories --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-rectangle-stack class="w-6 h-6 text-white" />
                </div>
                <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">+5%</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Total Categories</h3>
            <p class="text-3xl font-bold text-gray-800">24</p>
        </div>

        {{-- New Messages --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-chat-bubble-left-right class="w-6 h-6 text-white" />
                </div>
                <span class="text-xs font-semibold text-red-600 bg-red-50 px-2 py-1 rounded-full">New</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">New Messages</h3>
            <p class="text-3xl font-bold text-gray-800">12</p>
        </div>

        {{-- Total Gallery --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-photo class="w-6 h-6 text-white" />
                </div>
                <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-2 py-1 rounded-full">+8%</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Total Gallery</h3>
            <p class="text-3xl font-bold text-gray-800">156</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        {{-- Quick Actions --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <button class="w-full flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl transition">
                        <x-heroicon-o-plus class="w-5 h-5" />
                        Add Product
                    </button>

                    <button class="w-full flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white rounded-xl transition">
                        <x-heroicon-o-plus class="w-5 h-5" />
                        Add Category
                    </button>

                    <button class="w-full flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-xl transition">
                        <x-heroicon-o-photo class="w-5 h-5" />
                        Upload Photo
                    </button>

                    <button wire:click="logout" class="w-full flex items-center gap-3 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                        Logout
                    </button>
                </div>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    @foreach([
                        ['action' => 'Added new product', 'detail' => 'Red Tail Guppy Fish', 'time' => '5 minutes ago', 'icon' => 'plus'],
                        ['action' => 'Updated category', 'detail' => 'Tetra Fish', 'time' => '15 minutes ago', 'icon' => 'pencil-square'],
                        ['action' => 'Uploaded gallery photos', 'detail' => '3 new photos', 'time' => '1 hour ago', 'icon' => 'photo'],
                        ['action' => 'New message received', 'detail' => 'From customer@email.com', 'time' => '2 hours ago', 'icon' => 'chat-bubble-left-right'],
                    ] as $activity)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <x-dynamic-component :component="'heroicon-o-' . $activity['icon']" class="w-5 h-5 text-white" />
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-800">{{ $activity['action'] }}</p>
                                <p class="text-xs text-gray-600">{{ $activity['detail'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Welcome Message --}}
    <div class="bg-blue-600 rounded-2xl p-8 text-white shadow-lg">
        <h2 class="text-2xl font-bold mb-2">Welcome to Admin Dashboard!</h2>
        <p class="text-blue-50 mb-6">PT. Tropis Fish Indonesia - Content Management System</p>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('home') }}" target="_blank" class="px-6 py-3 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg transition font-semibold">
                View Website
            </a>
            <button class="px-6 py-3 bg-white text-blue-600 hover:bg-blue-50 rounded-lg transition font-semibold">
                Documentation
            </button>
        </div>
    </div>
</div>
