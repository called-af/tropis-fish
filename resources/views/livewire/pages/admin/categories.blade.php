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
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">Categories Management</h1>
            <p class="text-sm sm:text-base text-gray-400">Manage your fish stock product categories</p>
        </div>
        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus" class="self-start sm:self-auto">
            Add Category
        </x-atoms.button>
    </div>

    {{-- Search Section --}}
    <div class="mb-8">
        <x-atoms.search-input
            wire:model.live="search"
            placeholder="Search categories by name or slug..."
        />
    </div>

    {{-- Categories Table (Desktop) --}}
    @if($categories->count() > 0)
        <div class="hidden lg:block bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl mb-8">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-900/50 border-b border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Banner Image</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Detail Hero</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Sort Order</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Active Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($categories as $category)
                            <tr class="hover:bg-gray-900/30 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($category->image_path)
                                        <img src="{{ asset("storage/{$category->image_path}") }}" alt="{{ $category->name }}" class="w-24 h-12 object-cover rounded-lg border border-amber-500/30">
                                    @else
                                        <div class="w-24 h-12 bg-gray-700 rounded-lg flex items-center justify-center">
                                            <x-heroicon-o-photo class="w-6 h-6 text-gray-500" />
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-white font-semibold">{{ $category->name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-amber-500 font-mono text-sm bg-amber-500/10 px-2 py-1 rounded-md">{{ $category->slug }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($category->detail_title || $category->detail_description)
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-emerald-900/40 border border-emerald-700 text-emerald-300">
                                            <x-heroicon-o-check-circle class="w-3 h-3" />
                                            Configured
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-gray-700/40 border border-gray-600 text-gray-400">
                                            <x-heroicon-o-minus-circle class="w-3 h-3" />
                                            Not Set
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-300">{{ $category->sort_order }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button
                                        wire:click="toggleStatus({{ $category->id }})"
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $category->is_active ? 'bg-green-900/40 border border-green-700 text-green-300' : 'bg-red-900/40 border border-red-700 text-red-300' }}"
                                    >
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <x-atoms.button
                                            wire:click="edit({{ $category->id }})"
                                            variant="primary"
                                            icon="pencil"
                                            size="sm"
                                        >
                                            Edit
                                        </x-atoms.button>
                                        <x-atoms.button
                                            wire:click="confirmDelete({{ $category->id }})"
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

        {{-- Categories Cards (Mobile & Tablet) --}}
        <div class="lg:hidden space-y-4 mb-8">
            @foreach($categories as $category)
                <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl">
                    <div class="p-4">
                        <div class="flex gap-4 mb-4">
                            @if($category->image_path)
                                <img src="{{ asset("storage/{$category->image_path}") }}" alt="{{ $category->name }}" class="w-24 h-16 object-cover rounded-lg border border-amber-500/30 flex-shrink-0">
                            @else
                                <div class="w-24 h-16 bg-gray-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <x-heroicon-o-photo class="w-8 h-8 text-gray-500" />
                                </div>
                            @endif

                            <div class="flex-1 min-w-0">
                                <h3 class="text-white font-bold text-base mb-1">{{ $category->name }}</h3>
                                <p class="text-amber-500 font-mono text-xs truncate bg-amber-500/10 px-2 py-0.5 rounded-md inline-block">{{ $category->slug }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="bg-gray-900/50 rounded-lg p-3">
                                <p class="text-xs text-gray-400 mb-1">Sort Order</p>
                                <p class="text-white font-semibold text-sm">{{ $category->sort_order }}</p>
                            </div>
                            <div class="bg-gray-900/50 rounded-lg p-3">
                                <p class="text-xs text-gray-400 mb-1">Status</p>
                                <button
                                    wire:click="toggleStatus({{ $category->id }})"
                                    class="text-xs font-semibold {{ $category->is_active ? 'text-green-400' : 'text-red-400' }}"
                                >
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <x-atoms.button
                                wire:click="edit({{ $category->id }})"
                                variant="primary"
                                icon="pencil"
                                size="sm"
                                class="flex-1"
                            >
                                Edit
                            </x-atoms.button>
                            <x-atoms.button
                                wire:click="confirmDelete({{ $category->id }})"
                                variant="outline"
                                icon="trash"
                                size="sm"
                                class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10 flex-1"
                            >
                                Delete
                            </x-atoms.button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($categories->hasPages())
            <div class="flex justify-center">
                {{ $categories->links() }}
            </div>
        @endif
    @else
        {{-- Empty State --}}
        <div class="bg-gray-800 rounded-2xl border border-gray-700 p-12 sm:p-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-16 sm:w-20 h-16 sm:h-20 bg-gray-700/50 rounded-full flex items-center justify-center">
                    <x-heroicon-o-tag class="w-8 sm:w-10 h-8 sm:h-10 text-amber-500/50" />
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-semibold text-white mb-1">No categories found</h3>
                    <p class="text-sm text-gray-400 mb-4">
                        @if($search)
                            No results for "{{ $search }}". Try a different search term.
                        @else
                            Create your first category to get started
                        @endif
                    </p>
                    @if(!$search)
                        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
                            Add Category
                        </x-atoms.button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Form Modal --}}
    <x-molecules.modal wire:model="showFormModal" max-width="3xl">
        <div class="p-4 sm:p-6 md:p-8">
            <div class="flex items-center gap-3 mb-6 sm:mb-8">
                <div class="w-8 sm:w-10 h-8 sm:h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <x-heroicon-o-tag class="w-5 sm:w-6 h-5 sm:h-6 text-white" />
                </div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">{{ $editingId ? 'Edit Category' : 'Add New Category' }}</h2>
            </div>

            <form wire:submit="save" class="space-y-4 sm:space-y-6">
                {{-- Basic Info Section --}}
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-center gap-2 text-sm font-semibold text-amber-500 uppercase tracking-wider">
                        <x-heroicon-o-information-circle class="w-4 h-4" />
                        Basic Information
                    </div>

                    <x-atoms.input
                        type="text"
                        wire:model.live="name"
                        label="Category Name *"
                        placeholder="e.g., Corydoras"
                        :error="$errors->first('name')"
                        required
                    />

                    <x-atoms.input
                        type="text"
                        wire:model="slug"
                        label="Slug *"
                        placeholder="e.g., corydoras"
                        :error="$errors->first('slug')"
                        required
                    />

                    <x-atoms.textarea
                        wire:model="description"
                        label="Description"
                        placeholder="Describe this category..."
                        rows="3"
                        :error="$errors->first('description')"
                    />

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <x-atoms.input
                            type="number"
                            wire:model="sortOrder"
                            label="Sort Order *"
                            placeholder="e.g., 10"
                            :error="$errors->first('sortOrder')"
                            required
                        />

                        <div class="flex flex-col">
                            <span class="block text-sm font-semibold text-amber-500 mb-2">Status</span>
                            <label class="relative flex items-center justify-center p-3 border-2 bg-gray-700/50 rounded-xl cursor-pointer transition select-none {{ $isActive ? 'border-amber-500 bg-amber-500/10' : 'border-gray-600' }}">
                                <input type="checkbox" wire:model.live="isActive" class="sr-only">
                                <span class="text-sm font-semibold {{ $isActive ? 'text-amber-500' : 'text-gray-400' }}">
                                    {{ $isActive ? 'Active (Shows on Website)' : 'Inactive (Hidden)' }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div x-data="fileInputData">
                        <x-atoms.file-input
                            wire:model="image"
                            accept="image/*"
                            label="Category Banner Image"
                            :error="$errors->first('image')"
                            id="category-image-input"
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
                </div>

                {{-- Divider --}}
                <div class="border-t border-gray-700 pt-2"></div>

                {{-- Detail/Hero Section --}}
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-center gap-2 text-sm font-semibold text-amber-500 uppercase tracking-wider">
                        <x-heroicon-o-sparkles class="w-4 h-4" />
                        Category Detail Page (Hero)
                    </div>
                    <p class="text-xs text-gray-400 -mt-2">These fields control how the category looks on its landing page hero section.</p>

                    <x-atoms.input
                        type="text"
                        wire:model="detailTitle"
                        label="Detail Title"
                        placeholder="e.g., Premium Corydoras Collection"
                        :error="$errors->first('detailTitle')"
                    />

                    <x-atoms.textarea
                        wire:model="detailDescription"
                        label="Detail Description"
                        placeholder="Detailed description for the category landing page hero..."
                        rows="4"
                        :error="$errors->first('detailDescription')"
                    />

                    <div x-data="fileInputData">
                        <x-atoms.file-input
                            wire:model="detailImage"
                            accept="image/*"
                            label="Detail Section Image"
                            :error="$errors->first('detailImage')"
                            id="category-detail-image-input"
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">Displayed alongside the detail content on the category page</p>
                            </x-slot:help>
                            <x-slot:preview>
                                @if ($detailImage)
                                    <div class="relative group inline-block">
                                        <img src="{{ $detailImage->temporaryUrl() }}" class="h-48 w-auto object-cover rounded-xl border-2 border-amber-500/50 shadow-lg">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    </div>
                                @endif
                            </x-slot:preview>
                        </x-atoms.file-input>
                    </div>
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-700">
                    <x-atoms.button type="submit" variant="secondary" icon="check">
                        {{ $editingId ? 'Update Category' : 'Create Category' }}
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
        <div class="p-4 sm:p-6 md:p-8">
            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                <div class="w-10 sm:w-12 h-10 sm:h-12 bg-red-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                    <x-heroicon-o-exclamation-triangle class="w-6 sm:w-7 h-6 sm:h-7 text-red-400" />
                </div>
                <div class="min-w-0">
                    <h2 class="text-lg sm:text-xl font-bold text-white">Delete Category</h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-1">This action cannot be undone</p>
                </div>
            </div>

            <p class="text-sm sm:text-base text-gray-300 mb-4 sm:mb-6">
                Are you sure you want to delete this category? All associated fish products will remain in the system, but their category will be set to None.
            </p>

            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                <x-atoms.button wire:click="delete" variant="outline" icon="trash" class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10 w-full sm:w-auto">
                    Delete
                </x-atoms.button>
                <x-atoms.button wire:click="$set('showDeleteModal', false)" variant="outline" icon="x-mark" class="w-full sm:w-auto">
                    Cancel
                </x-atoms.button>
            </div>
        </div>
    </x-molecules.modal>
</div>
