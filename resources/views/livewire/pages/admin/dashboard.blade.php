<div class="max-w-7xl mx-auto">
    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="mb-6 bg-green-900/50 border border-green-700 text-green-300 px-6 py-4 rounded-xl flex items-center justify-between"
            role="alert"
        >
            <div class="flex items-center gap-3">
                <x-heroicon-o-check-circle class="w-5 h-5" />
                <span class="font-medium">{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="text-green-300 hover:text-green-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        {{-- Total Messages --}}
        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 shadow-xl hover:border-blue-500/50 transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-envelope class="w-6 h-6 text-white" />
                </div>
                @if($stats['unread_messages'] > 0)
                    <span class="text-xs font-semibold text-red-400 bg-red-900/50 px-2 py-1 rounded-full">{{ $stats['unread_messages'] }} New</span>
                @endif
            </div>
            <h3 class="text-gray-400 text-sm font-medium mb-1">Total Messages</h3>
            <p class="text-3xl font-bold text-white">{{ $stats['total_messages'] }}</p>
        </div>

        {{-- Total Heroes --}}
        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 shadow-xl hover:border-amber-500/50 transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-rectangle-stack class="w-6 h-6 text-white" />
                </div>
            </div>
            <h3 class="text-gray-400 text-sm font-medium mb-1">Hero Sliders</h3>
            <p class="text-3xl font-bold text-white">{{ $stats['total_heroes'] }}</p>
        </div>

        {{-- Total Stock Lists --}}
        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 shadow-xl hover:border-purple-500/50 transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-clipboard-document-list class="w-6 h-6 text-white" />
                </div>
            </div>
            <h3 class="text-gray-400 text-sm font-medium mb-1">Stock Lists</h3>
            <p class="text-3xl font-bold text-white">{{ $stats['total_stock_lists'] }}</p>
        </div>

        {{-- Total Galleries --}}
        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 shadow-xl hover:border-green-500/50 transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-photo class="w-6 h-6 text-white" />
                </div>
            </div>
            <h3 class="text-gray-400 text-sm font-medium mb-1">Gallery Images</h3>
            <p class="text-3xl font-bold text-white">{{ $stats['total_galleries'] }}</p>
        </div>

        {{-- Total Stats --}}
        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 shadow-xl hover:border-pink-500/50 transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-chart-bar class="w-6 h-6 text-white" />
                </div>
            </div>
            <h3 class="text-gray-400 text-sm font-medium mb-1">Stats Items</h3>
            <p class="text-3xl font-bold text-white">{{ $stats['total_stats'] }}</p>
        </div>

        {{-- Quick Actions Card --}}
        <div class="bg-gradient-to-br from-blue-600 to-amber-600 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center gap-3 mb-4">
                <x-heroicon-o-rocket-launch class="w-6 h-6 text-white" />
                <h3 class="text-white text-lg font-bold">Quick Actions</h3>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.stock-lists') }}" class="flex items-center gap-2 text-white/90 hover:text-white text-sm transition">
                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                    Manage Stock Lists
                </a>
                <a href="{{ route('admin.galleries') }}" class="flex items-center gap-2 text-white/90 hover:text-white text-sm transition">
                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                    Manage Gallery
                </a>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-white/90 hover:text-white text-sm transition">
                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                    View Website
                </a>
            </div>
        </div>
    </div>

    {{-- Contact Messages Section --}}
    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <x-heroicon-o-envelope class="w-6 h-6 text-amber-400" />
                <h2 class="text-2xl font-bold text-white">Contact Messages</h2>
            </div>
            @if($stats['unread_messages'] > 0)
                <span class="text-sm font-semibold text-red-400 bg-red-900/50 px-3 py-1 rounded-full">
                    {{ $stats['unread_messages'] }} Unread
                </span>
            @endif
        </div>

        {{-- Search --}}
        <div class="mb-6">
            <x-atoms.search-input
                wire:model.live="messageSearch"
                placeholder="Search messages by name, email, or subject..."
            />
        </div>

        {{-- Messages Table --}}
        @if($messages->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-900/50 border-b border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Subject</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($messages as $message)
                            <tr class="hover:bg-gray-900/30 transition {{ !$message->is_read ? 'bg-blue-900/10' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($message->is_read)
                                        <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-gray-700 text-gray-300">
                                            <x-heroicon-o-envelope-open class="w-3 h-3" />
                                            Read
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-blue-900/50 text-blue-300 border border-blue-700">
                                            <x-heroicon-o-envelope class="w-3 h-3" />
                                            New
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-white font-medium">{{ $message->name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-300">{{ $message->email }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-300">{{ Str::limit($message->subject, 30) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-400 text-sm">{{ $message->created_at->diffForHumans() }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <x-atoms.button
                                            wire:click="viewMessage({{ $message->id }})"
                                            variant="primary"
                                            icon="eye"
                                            size="sm"
                                        >
                                            View
                                        </x-atoms.button>
                                        @if(!$message->is_read)
                                            <x-atoms.button
                                                wire:click="markAsRead({{ $message->id }})"
                                                variant="outline"
                                                icon="check"
                                                size="sm"
                                            >
                                                Mark Read
                                            </x-atoms.button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($messages->hasPages())
                <div class="flex justify-center mt-6">
                    {{ $messages->links() }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="text-center py-16">
                <div class="flex flex-col items-center gap-4">
                    <div class="w-20 h-20 bg-gray-700/50 rounded-full flex items-center justify-center">
                        <x-heroicon-o-envelope class="w-10 h-10 text-amber-400/50" />
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-1">No messages found</h3>
                        <p class="text-sm text-gray-400">
                            @if($messageSearch)
                                No results for "{{ $messageSearch }}". Try a different search term.
                            @else
                                Messages from the contact form will appear here
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Message Detail Modal --}}
    @if($viewingMessage)
        <x-molecules.modal wire:model="showMessageModal" max-width="3xl">
            <div class="p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-envelope class="w-6 h-6 text-white" />
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-white">Message Details</h2>
                        <p class="text-sm text-gray-400">{{ $viewingMessage->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Name</label>
                            <p class="text-white font-medium">{{ $viewingMessage->name }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Email</label>
                            <p class="text-white font-medium">{{ $viewingMessage->email }}</p>
                        </div>
                    </div>

                    @if($viewingMessage->phone)
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Phone</label>
                            <p class="text-white font-medium">{{ $viewingMessage->phone }}</p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Subject</label>
                        <p class="text-white font-medium">{{ $viewingMessage->subject }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Message</label>
                        <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                            <p class="text-gray-300 whitespace-pre-wrap">{{ $viewingMessage->message }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-700 mt-8">
                    <x-atoms.button
                        wire:click="deleteMessage({{ $viewingMessage->id }})"
                        variant="outline"
                        icon="trash"
                        class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10"
                    >
                        Delete Message
                    </x-atoms.button>

                    <x-atoms.button
                        wire:click="$set('showMessageModal', false)"
                        variant="outline"
                        icon="x-mark"
                    >
                        Close
                    </x-atoms.button>
                </div>
            </div>
        </x-molecules.modal>
    @endif
</div>
