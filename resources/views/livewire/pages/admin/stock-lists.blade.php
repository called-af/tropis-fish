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
            <h1 class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">Stock List Management</h1>
            <p class="text-sm sm:text-base text-gray-400">Manage your fish stock inventory</p>
        </div>
        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus" class="self-start sm:self-auto">
            Add Stock Item
        </x-atoms.button>
    </div>

    {{-- Download Section --}}
    <div class="mb-8 bg-gray-800 rounded-2xl border border-gray-700 p-4 sm:p-6">
        <div class="flex items-center gap-3 mb-4 sm:mb-6">
            <x-heroicon-o-arrow-down-tray class="w-5 h-5 text-amber-500 flex-shrink-0" />
            <h3 class="text-base sm:text-lg font-semibold text-white">Stock List Download</h3>
        </div>

        <form wire:submit="saveDownloadLink" class="space-y-4 sm:space-y-6">
            {{-- Type Selection --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-3">Download Type *</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <label class="relative flex items-center justify-center p-3 sm:p-4 border-2 rounded-xl cursor-pointer transition {{ $downloadType === 'link' ? 'border-amber-500 bg-amber-500/10' : 'border-gray-600 bg-gray-700/50 hover:border-gray-500' }}">
                        <input type="radio" wire:model.live="downloadType" value="link" class="sr-only">
                        <div class="text-center">
                            <x-heroicon-o-link class="w-6 sm:w-8 h-6 sm:h-8 mx-auto mb-1 sm:mb-2 {{ $downloadType === 'link' ? 'text-amber-500' : 'text-gray-400' }}" />
                            <span class="text-sm font-semibold {{ $downloadType === 'link' ? 'text-amber-500' : 'text-gray-300' }}">External Link</span>
                            <p class="text-xs text-gray-500 mt-1">PDF, Google Drive, etc</p>
                        </div>
                    </label>

                    <label class="relative flex items-center justify-center p-3 sm:p-4 border-2 rounded-xl cursor-pointer transition {{ $downloadType === 'file' ? 'border-amber-500 bg-amber-500/10' : 'border-gray-600 bg-gray-700/50 hover:border-gray-500' }}">
                        <input type="radio" wire:model.live="downloadType" value="file" class="sr-only">
                        <div class="text-center">
                            <x-heroicon-o-document-arrow-up class="w-6 sm:w-8 h-6 sm:h-8 mx-auto mb-1 sm:mb-2 {{ $downloadType === 'file' ? 'text-amber-500' : 'text-gray-400' }}" />
                            <span class="text-sm font-semibold {{ $downloadType === 'file' ? 'text-amber-500' : 'text-gray-300' }}">Upload File</span>
                            <p class="text-xs text-gray-500 mt-1">PDF, Excel (Max 10MB)</p>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Link Input --}}
            @if($downloadType === 'link')
                <x-atoms.input
                    type="url"
                    wire:model="downloadLink"
                    label="Download URL *"
                    placeholder="https://example.com/stocklist.pdf or Google Drive link"
                    :error="$errors->first('downloadLink')"
                    required
                />
            @endif

            {{-- File Upload --}}
            @if($downloadType === 'file')
                <div x-data="fileInputData">
                    <x-atoms.file-input
                        wire:model="downloadFile"
                        accept=".pdf,.xlsx,.xls,.csv"
                        label="Upload File *"
                        :error="$errors->first('downloadFile')"
                        id="download-file-input"
                        required
                    >
                        <x-slot:help>
                            <p class="text-xs text-gray-500 mt-1">Accepted: PDF, Excel (XLSX, XLS, CSV) - Max 10MB</p>
                        </x-slot:help>
                    </x-atoms.file-input>
                </div>

                @if($this->currentFile)
                    <div class="flex items-center gap-2 text-sm text-gray-400 bg-gray-700/50 p-3 rounded-lg">
                        <x-heroicon-o-document class="w-4 h-4 text-amber-500" />
                        <span>Current file: <span class="text-white font-medium">{{ basename($this->currentFile) }}</span></span>
                    </div>
                @endif
            @endif

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-4 border-t border-gray-700">
                <p class="text-xs text-gray-500">This will appear at the bottom of the public Stock List page</p>
                <x-atoms.button type="submit" variant="secondary" icon="check" class="w-full sm:w-auto">
                    {{ $downloadType === 'file' ? 'Upload & Save' : 'Save Link' }}
                </x-atoms.button>
            </div>
        </form>
    </div>

    {{-- Search Section --}}
    <div class="mb-8">
        <x-atoms.search-input
            wire:model.live="search"
            placeholder="Search by common name or scientific name..."
        />
    </div>

    {{-- Stock List Table (Desktop) --}}
    @if($stockLists->count() > 0)
        <div class="hidden lg:block bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl mb-8">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-900/50 border-b border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Common Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Scientific Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Length (cm)</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($stockLists as $stockList)
                            <tr class="hover:bg-gray-900/30 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($stockList->image_path)
                                        <img src="{{ asset("storage/{$stockList->image_path}") }}" alt="{{ $stockList->common_name }}" class="w-16 h-16 object-cover rounded-lg border border-amber-500/30">
                                    @else
                                        <div class="w-16 h-16 bg-gray-700 rounded-lg flex items-center justify-center">
                                            <x-heroicon-o-photo class="w-8 h-8 text-gray-500" />
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-blue-400 font-semibold">{{ $stockList->category?->name ?? 'None' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-white font-medium">{{ $stockList->common_name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-300 italic">{{ $stockList->scientific_name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-300">{{ $stockList->length }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <x-atoms.button
                                            wire:click="edit({{ $stockList->id }})"
                                            variant="primary"
                                            icon="pencil"
                                            size="sm"
                                        >
                                            Edit
                                        </x-atoms.button>
                                        <x-atoms.button
                                            wire:click="confirmDelete({{ $stockList->id }})"
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

        {{-- Stock List Cards (Mobile & Tablet) --}}
        <div class="lg:hidden space-y-4 mb-8">
            @foreach($stockLists as $stockList)
                <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl">
                    <div class="p-4">
                        <div class="flex gap-4 mb-4">
                            @if($stockList->image_path)
                                <img src="{{ asset("storage/{$stockList->image_path}") }}" alt="{{ $stockList->common_name }}" class="w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-lg border border-amber-500/30 flex-shrink-0">
                            @else
                                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gray-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <x-heroicon-o-photo class="w-10 h-10 text-gray-500" />
                                </div>
                            @endif

                            <div class="flex-1 min-w-0">
                                <div class="mb-2 flex flex-wrap gap-2 items-center">
                                    @if($stockList->category)
                                        <span class="inline-block text-blue-400 text-xs font-semibold px-2 py-1 bg-blue-500/10 rounded-lg">{{ $stockList->category->name }}</span>
                                    @endif
                                </div>
                                <h3 class="text-white font-bold text-base sm:text-lg mb-1">{{ $stockList->common_name }}</h3>
                                <p class="text-gray-400 italic text-sm truncate">{{ $stockList->scientific_name }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-3 mb-4">
                            <div class="bg-gray-900/50 rounded-lg p-3">
                                <p class="text-xs text-gray-400 mb-1">Length</p>
                                <p class="text-white font-semibold">{{ $stockList->length }} cm</p>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <x-atoms.button
                                wire:click="edit({{ $stockList->id }})"
                                variant="primary"
                                icon="pencil"
                                size="sm"
                                class="flex-1"
                            >
                                Edit
                            </x-atoms.button>
                            <x-atoms.button
                                wire:click="confirmDelete({{ $stockList->id }})"
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
        @if($stockLists->hasPages())
            <div class="flex justify-center">
                {{ $stockLists->links() }}
            </div>
        @endif
    @else
        {{-- Empty State --}}
        <div class="bg-gray-800 rounded-2xl border border-gray-700 p-12 sm:p-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-16 sm:w-20 h-16 sm:h-20 bg-gray-700/50 rounded-full flex items-center justify-center">
                    <x-heroicon-o-clipboard-document-list class="w-8 sm:w-10 h-8 sm:h-10 text-amber-500/50" />
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-semibold text-white mb-1">No stock items found</h3>
                    <p class="text-sm text-gray-400 mb-4">
                        @if($search)
                            No results for "{{ $search }}". Try a different search term.
                        @else
                            Create your first stock item to get started
                        @endif
                    </p>
                    @if(!$search)
                        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
                            Add Stock Item
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
                    <x-heroicon-o-clipboard-document-list class="w-5 sm:w-6 h-5 sm:h-6 text-white" />
                </div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">{{ $editingId ? 'Edit Stock Item' : 'Add New Stock Item' }}</h2>
            </div>

            <form wire:submit="save" class="space-y-4 sm:space-y-6">
                <x-atoms.select
                    wire:model="categoryId"
                    label="Category"
                    placeholder="Select Category (None)"
                    :error="$errors->first('categoryId')"
                >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-atoms.select>

                <x-atoms.input
                    type="text"
                    wire:model="commonName"
                    label="Common Name *"
                    placeholder="e.g., Discus Blue Diamond"
                    :error="$errors->first('commonName')"
                    required
                />

                <x-atoms.input
                    type="text"
                    wire:model="scientificName"
                    label="Scientific Name *"
                    placeholder="e.g., Symphysodon aequifasciatus"
                    :error="$errors->first('scientificName')"
                    required
                />

                <x-atoms.input
                    type="text"
                    wire:model="length"
                    label="Length (cm) *"
                    placeholder="e.g., 18"
                    :error="$errors->first('length')"
                    required
                />

                <div x-data="fileInputData">
                    <x-atoms.file-input
                        wire:model="image"
                        accept="image/*"
                        :label="(!$editingId ? 'Product Image *' : 'Product Image')"
                        :error="$errors->first('image')"
                        id="stock-image-input"
                        :required="!$editingId"
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
                        {{ $editingId ? 'Update Stock Item' : 'Create Stock Item' }}
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
                    <h2 class="text-lg sm:text-xl font-bold text-white">Delete Stock Item</h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-1">This action cannot be undone</p>
                </div>
            </div>

            <p class="text-sm sm:text-base text-gray-300 mb-4 sm:mb-6">
                Are you sure you want to delete this stock item? All associated data will be permanently removed.
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
