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

    {{-- Header with Add Button --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Gallery Management</h1>
            <p class="text-gray-400">Manage your fish gallery images</p>
        </div>
        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
            Add Gallery
        </x-atoms.button>
    </div>

    {{-- Search and Filter Section --}}
    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <x-atoms.search-input
            wire:model.live="search"
            placeholder="Search galleries by title..."
        />

        <x-atoms.select
            wire:model.live="categoryFilter"
            :options="[
                '' => 'All Categories',
                'fish' => 'Fish Gallery',
                'farm' => 'Farm Gallery',
                'quality' => 'Quality Control'
            ]"
        />
    </div>

    {{-- Gallery Grid --}}
    @if($galleries->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
            @foreach($galleries as $gallery)
                <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl hover:border-amber-500/50 transition group">
                    {{-- Image --}}
                    <div class="aspect-square relative overflow-hidden">
                        <img
                            src="{{ asset("storage/{$gallery->image_path}") }}"
                            alt="{{ $gallery->title }}"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <p class="text-white font-semibold text-sm line-clamp-1">{{ $gallery->title }}</p>
                                <div class="flex items-center gap-2 mt-1 flex-wrap">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-amber-900/80 text-amber-500">
                                        @if($gallery->category === 'fish')
                                            Fish
                                        @elseif($gallery->category === 'farm')
                                            Farm
                                        @else
                                            Quality
                                        @endif
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-700/80 text-gray-300">
                                        <x-heroicon-o-numbered-list class="w-3 h-3 text-amber-500" />
                                        {{ $gallery->order }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full {{ $gallery->is_active ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                                        @if($gallery->is_active)
                                            <x-heroicon-o-check-circle class="w-3 h-3" />
                                            Active
                                        @else
                                            <x-heroicon-o-x-circle class="w-3 h-3" />
                                            Inactive
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="p-4 flex gap-2">
                        <x-atoms.button
                            wire:click="edit({{ $gallery->id }})"
                            variant="primary"
                            icon="pencil"
                            size="sm"
                            class="flex-1"
                        >
                            Edit
                        </x-atoms.button>
                        <x-atoms.button
                            wire:click="confirmDelete({{ $gallery->id }})"
                            variant="outline"
                            icon="trash"
                            size="sm"
                            class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10 flex-1"
                        >
                            Delete
                        </x-atoms.button>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($galleries->hasPages())
            <div class="flex justify-center">
                {{ $galleries->links() }}
            </div>
        @endif
    @else
        {{-- Empty State --}}
        <div class="bg-gray-800 rounded-2xl border border-gray-700 p-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-20 h-20 bg-gray-700/50 rounded-full flex items-center justify-center">
                    <x-heroicon-o-photo class="w-10 h-10 text-amber-500/50" />
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-1">No galleries found</h3>
                    <p class="text-sm text-gray-400 mb-4">
                        @if($search)
                            No results for "{{ $search }}". Try a different search term.
                        @else
                            Create your first gallery to get started
                        @endif
                    </p>
                    @if(!$search)
                        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
                            Add Gallery
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
                    <x-heroicon-o-photo class="w-6 h-6 text-white" />
                </div>
                <h2 class="text-2xl font-bold text-white">{{ $editingId ? 'Edit Gallery' : 'Add New Gallery' }}</h2>
            </div>

            <form wire:submit="save" class="space-y-6">
                <x-atoms.input
                    type="text"
                    wire:model="title"
                    label="Title *"
                    placeholder="Enter gallery title"
                    :error="$errors->first('title')"
                    required
                />

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <x-atoms.textarea
                        wire:model="description"
                        placeholder="Enter gallery description (optional)"
                        rows="3"
                        :error="$errors->first('description')"
                    />
                </div>

                <x-atoms.select
                    wire:model="category"
                    label="Category *"
                    :options="[
                        'fish' => 'Fish Gallery',
                        'farm' => 'Farm Gallery',
                        'quality' => 'Quality Control'
                    ]"
                    :error="$errors->first('category')"
                    required
                />

                <div x-data="fileInputData">
                    <x-atoms.file-input
                        wire:model="image"
                        accept="image/*"
                        :label="(!$editingId ? 'Image *' : 'Image')"
                        :error="$errors->first('image')"
                        id="gallery-image-input"
                    >
                        <x-slot:preview>
                            @if ($image)
                                <div class="relative group inline-block">
                                    <img src="{{ $image->temporaryUrl() }}" class="h-48 w-auto object-cover rounded-xl border-2 border-amber-500/50 shadow-lg">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                            @endif
                        </x-slot:preview>
                    </x-atoms.file-input>
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-700">
                    <x-atoms.button type="submit" variant="secondary" icon="check">
                        {{ $editingId ? 'Update Gallery' : 'Create Gallery' }}
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
                    <h2 class="text-xl font-bold text-white">Delete Gallery</h2>
                    <p class="text-sm text-gray-400 mt-1">This action cannot be undone</p>
                </div>
            </div>

            <p class="text-gray-300 mb-6">
                Are you sure you want to delete this gallery? All associated data will be permanently removed.
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
