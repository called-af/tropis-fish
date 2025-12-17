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

    @if (session()->has('error'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="mb-6 bg-red-900/50 border border-red-700 text-red-300 px-6 py-4 rounded-xl flex items-center justify-between"
            role="alert"
        >
            <div class="flex items-center gap-3">
                <x-heroicon-o-exclamation-circle class="w-5 h-5" />
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            <button @click="show = false" class="text-red-300 hover:text-red-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>
    @endif

    {{-- Header with Add Button --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Stats Management</h1>
            <p class="text-gray-400">Manage your homepage statistics (Max 4 stats)</p>
        </div>
        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
            Add Stat
        </x-atoms.button>
    </div>

    {{-- Stats Section Settings --}}
    <div class="mb-8 bg-gray-800 rounded-2xl border border-gray-700 p-6">
        <div class="flex items-center gap-3 mb-6">
            <x-heroicon-o-cog-6-tooth class="w-5 h-5 text-amber-500" />
            <h3 class="text-lg font-semibold text-white">Stats Section Settings</h3>
        </div>

        <form wire:submit="saveSettings" class="space-y-6">
            <x-atoms.input
                type="text"
                wire:model="statsTitle"
                label="Section Title *"
                placeholder="e.g., Trusted by Thousands of Customers"
                :error="$errors->first('statsTitle')"
                required
            />

            <x-atoms.textarea
                wire:model="statsDescription"
                label="Section Description *"
                placeholder="e.g., Our experience and dedication in the ornamental fish industry"
                :error="$errors->first('statsDescription')"
                rows="3"
                required
            />

            <div class="flex items-center justify-between pt-4 border-t border-gray-700">
                <p class="text-xs text-gray-500">This will appear at the top of the stats section on the homepage</p>
                <x-atoms.button type="submit" variant="secondary" icon="check">
                    Save Settings
                </x-atoms.button>
            </div>
        </form>
    </div>

    {{-- Search Section --}}
    <div class="mb-8">
        <x-atoms.search-input
            wire:model.live="search"
            placeholder="Search stats by label or value..."
        />
    </div>

    {{-- Stats Table --}}
    @if($stats->count() > 0)
        <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl mb-8">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-900/50 border-b border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Label</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Value</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($stats as $stat)
                            <tr class="hover:bg-gray-900/30 transition">
                                <td class="px-6 py-4">
                                    <span class="text-white font-medium">{{ $stat->label }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-amber-500 font-bold text-lg">{{ $stat->value }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-gray-700 text-gray-300">
                                        <x-heroicon-o-numbered-list class="w-3 h-3 text-amber-500" />
                                        {{ $stat->order }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full {{ $stat->is_active ? 'bg-green-900/50 text-green-300 border border-green-700' : 'bg-red-900/50 text-red-300 border border-red-700' }}">
                                        @if($stat->is_active)
                                            <x-heroicon-o-check-circle class="w-3 h-3" />
                                            Active
                                        @else
                                            <x-heroicon-o-x-circle class="w-3 h-3" />
                                            Inactive
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <x-atoms.button
                                            wire:click="edit({{ $stat->id }})"
                                            variant="primary"
                                            icon="pencil"
                                            size="sm"
                                        >
                                            Edit
                                        </x-atoms.button>
                                        <x-atoms.button
                                            wire:click="confirmDelete({{ $stat->id }})"
                                            variant="outline"
                                            icon="trash"
                                            size="sm"
                                            class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10"
                                        >
                                            Delete
                                        </x-atoms.button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if($stats->hasPages())
            <div class="flex justify-center">
                {{ $stats->links() }}
            </div>
        @endif
    @else
        {{-- Empty State --}}
        <div class="bg-gray-800 rounded-2xl border border-gray-700 p-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-20 h-20 bg-gray-700/50 rounded-full flex items-center justify-center">
                    <x-heroicon-o-chart-bar class="w-10 h-10 text-amber-500/50" />
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-1">No stats found</h3>
                    <p class="text-sm text-gray-400 mb-4">
                        @if($search)
                            No results for "{{ $search }}". Try a different search term.
                        @else
                            Create your first stat to get started (Max 4 stats)
                        @endif
                    </p>
                    @if(!$search)
                        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
                            Add Stat
                        </x-atoms.button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Form Modal --}}
    <x-molecules.modal wire:model="showFormModal" max-width="2xl">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-chart-bar class="w-6 h-6 text-white" />
                </div>
                <h2 class="text-2xl font-bold text-white">{{ $editingId ? 'Edit Stat' : 'Add New Stat' }}</h2>
            </div>

            <form wire:submit="save" class="space-y-6">
                <x-atoms.input
                    type="text"
                    wire:model="label"
                    label="Label *"
                    placeholder="e.g., Years Experience, Happy Clients"
                    :error="$errors->first('label')"
                    required
                />

                <x-atoms.input
                    type="text"
                    wire:model="value"
                    label="Value *"
                    placeholder="e.g., 15+, 500+"
                    :error="$errors->first('value')"
                    required
                />

                <div class="flex gap-3 pt-6 border-t border-gray-700">
                    <x-atoms.button type="submit" variant="secondary" icon="check">
                        {{ $editingId ? 'Update Stat' : 'Create Stat' }}
                    </x-atoms.button>

                    <x-atoms.button type="button" wire:click="cancelEdit" variant="outline" icon="x-mark">
                        Cancel
                    </x-atoms.button>
                </div>
            </form>
        </div>
    </x-molecules.modal>

    {{-- Delete Confirmation Modal --}}
    <x-molecules.modal wire:model="showDeleteModal" max-width="md">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-red-600/20 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-exclamation-triangle class="w-7 h-7 text-red-400" />
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Delete Stat</h2>
                    <p class="text-sm text-gray-400 mt-1">This action cannot be undone</p>
                </div>
            </div>

            <p class="text-gray-300 mb-6">
                Are you sure you want to delete this stat? All associated data will be permanently removed.
            </p>

            <div class="flex gap-3">
                <x-atoms.button wire:click="delete" variant="outline" icon="trash" class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10">
                    Delete
                </x-atoms.button>
                <x-atoms.button wire:click="$set('showDeleteModal', false)" variant="outline" icon="x-mark">
                    Cancel
                </x-atoms.button>
            </div>
        </div>
    </x-molecules.modal>
</div>
