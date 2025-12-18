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
            <h1 class="text-3xl font-bold text-white mb-2">Terms Management</h1>
            <p class="text-gray-400">Manage your terms and conditions sections</p>
        </div>
        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
            Add Term
        </x-atoms.button>
    </div>

    {{-- Search Section --}}
    <div class="mb-8">
        <x-atoms.search-input
            wire:model.live="search"
            placeholder="Search terms by title..."
        />
    </div>

    {{-- Terms Grid --}}
    @if($terms->count() > 0)
        <div class="grid grid-cols-1 gap-6 mb-8">
            @foreach($terms as $term)
                <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl hover:border-amber-500/50 transition">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-white mb-2">{{ $term->title }}</h3>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-gray-700 text-gray-300">
                                        <x-heroicon-o-numbered-list class="w-3 h-3 text-amber-500" />
                                        Order: {{ $term->order }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full {{ $term->is_active ? 'bg-green-900/50 text-green-300 border border-green-700' : 'bg-red-900/50 text-red-300 border border-red-700' }}">
                                        @if($term->is_active)
                                            <x-heroicon-o-check-circle class="w-3 h-3" />
                                            Active
                                        @else
                                            <x-heroicon-o-x-circle class="w-3 h-3" />
                                            Inactive
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 ml-4">
                                <x-atoms.button wire:click="edit({{ $term->id }})" variant="outline" icon="pencil" size="sm">
                                    Edit
                                </x-atoms.button>
                                <x-atoms.button wire:click="confirmDelete({{ $term->id }})" variant="danger" icon="trash" size="sm">
                                    Delete
                                </x-atoms.button>
                            </div>
                        </div>

                        {{-- Content Preview --}}
                        <div class="bg-gray-900/50 rounded-lg p-4">
                            <p class="text-gray-300 text-sm leading-relaxed whitespace-pre-line">{{ Str::limit($term->content, 200) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $terms->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <x-heroicon-o-document-text class="w-16 h-16 text-gray-600 mx-auto mb-4" />
            <p class="text-gray-400 text-lg">No terms found. Click "Add Term" to create one.</p>
        </div>
    @endif

    {{-- Form Modal --}}
    <x-molecules.modal wire:model="showFormModal" max-width="2xl">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-document-text class="w-6 h-6 text-white" />
                </div>
                <h2 class="text-2xl font-bold text-white">{{ $editingId ? 'Edit' : 'Create' }} Term</h2>
            </div>

            <form wire:submit="save" class="space-y-6">
                <x-atoms.input
                    type="text"
                    wire:model="title"
                    label="Title *"
                    placeholder="e.g., Price, Payment, Delivery Order"
                    :error="$errors->first('title')"
                    required
                />

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Content *</label>
                    <x-atoms.textarea
                        wire:model="content"
                        placeholder="Enter term content (supports multiple paragraphs)"
                        rows="8"
                        :error="$errors->first('content')"
                    />
                    <p class="mt-1 text-xs text-gray-400">Tip: Use double line breaks for new paragraphs</p>
                </div>

                {{-- Active Toggle --}}
                <div class="flex items-center gap-3">
                    <input
                        type="checkbox"
                        wire:model="isActive"
                        id="isActive"
                        class="w-4 h-4 text-amber-500 bg-gray-700 border-gray-600 rounded focus:ring-amber-500 focus:ring-2"
                    >
                    <label for="isActive" class="text-sm font-medium text-gray-300">Active</label>
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-700">
                    <x-atoms.button type="submit" variant="secondary" icon="check">
                        {{ $editingId ? 'Update' : 'Create' }} Term
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
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-white" />
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Delete Term</h2>
                    <p class="text-sm text-gray-400">This action cannot be undone</p>
                </div>
            </div>

            <p class="text-gray-300 mb-8">Are you sure you want to delete this term? This will permanently remove it from the database.</p>

            <div class="flex gap-3">
                <x-atoms.button wire:click="delete" variant="danger" icon="trash">
                    Delete Term
                </x-atoms.button>

                <x-atoms.button wire:click="$set('showDeleteModal', false)" variant="outline" icon="x-mark">
                    Cancel
                </x-atoms.button>
            </div>
        </div>
    </x-molecules.modal>
</div>
