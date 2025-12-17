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
            <h1 class="text-3xl font-bold text-white mb-2">About Sections Management</h1>
            <p class="text-gray-400">Manage your about us sections (Only 1 section can be active at a time)</p>
        </div>
        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
            Add Section
        </x-atoms.button>
    </div>

    {{-- Search Section --}}
    <div class="mb-8">
        <x-atoms.search-input
            wire:model.live="search"
            placeholder="Search sections by title..."
        />
    </div>

    {{-- About Sections Grid --}}
    @if($aboutSections->count() > 0)
        <div class="grid grid-cols-1 gap-6 mb-8">
            @foreach($aboutSections as $section)
                <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl hover:border-amber-500/50 transition">
                    <div class="md:flex">
                        {{-- Image --}}
                        <div class="md:w-1/3 aspect-video md:aspect-auto relative overflow-hidden">
                            @if($section->image_path)
                                <img
                                    src="{{ asset("storage/{$section->image_path}") }}"
                                    alt="{{ $section->title }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                                    <x-heroicon-o-photo class="w-16 h-16 text-gray-500" />
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="md:w-2/3 p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-white mb-2">{{ $section->title }}</h3>
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-gray-700 text-gray-300">
                                            <x-heroicon-o-numbered-list class="w-3 h-3 text-amber-500" />
                                            Order: {{ $section->order }}
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full {{ $section->is_active ? 'bg-green-900/50 text-green-300 border border-green-700' : 'bg-red-900/50 text-red-300 border border-red-700' }}">
                                            @if($section->is_active)
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

                            <p class="text-gray-300 text-sm mb-2 line-clamp-2">{!! $section->description_1 !!}</p>
                            @if($section->description_2)
                                <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $section->description_2 }}</p>
                            @endif

                            {{-- Features Grid --}}
                            @if($section->feature_1_title || $section->feature_2_title || $section->feature_3_title || $section->feature_4_title)
                                <div class="grid grid-cols-2 gap-3 mb-4">
                                    @if($section->feature_1_title)
                                        <div class="text-xs">
                                            <div class="font-semibold text-amber-500">{{ $section->feature_1_title }}</div>
                                            <div class="text-gray-400">{{ $section->feature_1_description }}</div>
                                        </div>
                                    @endif
                                    @if($section->feature_2_title)
                                        <div class="text-xs">
                                            <div class="font-semibold text-amber-500">{{ $section->feature_2_title }}</div>
                                            <div class="text-gray-400">{{ $section->feature_2_description }}</div>
                                        </div>
                                    @endif
                                    @if($section->feature_3_title)
                                        <div class="text-xs">
                                            <div class="font-semibold text-amber-500">{{ $section->feature_3_title }}</div>
                                            <div class="text-gray-400">{{ $section->feature_3_description }}</div>
                                        </div>
                                    @endif
                                    @if($section->feature_4_title)
                                        <div class="text-xs">
                                            <div class="font-semibold text-amber-500">{{ $section->feature_4_title }}</div>
                                            <div class="text-gray-400">{{ $section->feature_4_description }}</div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- Actions --}}
                            <div class="flex gap-2">
                                <x-atoms.button
                                    wire:click="edit({{ $section->id }})"
                                    variant="primary"
                                    icon="pencil"
                                    size="sm"
                                >
                                    Edit
                                </x-atoms.button>
                                <x-atoms.button
                                    wire:click="confirmDelete({{ $section->id }})"
                                    variant="outline"
                                    icon="trash"
                                    size="sm"
                                    class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10"
                                >
                                    Delete
                                </x-atoms.button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($aboutSections->hasPages())
            <div class="flex justify-center">
                {{ $aboutSections->links() }}
            </div>
        @endif
    @else
        {{-- Empty State --}}
        <div class="bg-gray-800 rounded-2xl border border-gray-700 p-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-20 h-20 bg-gray-700/50 rounded-full flex items-center justify-center">
                    <x-heroicon-o-information-circle class="w-10 h-10 text-amber-500/50" />
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-1">No about sections found</h3>
                    <p class="text-sm text-gray-400 mb-4">
                        @if($search)
                            No results for "{{ $search }}". Try a different search term.
                        @else
                            Create your first about section to get started
                        @endif
                    </p>
                    @if(!$search)
                        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
                            Add Section
                        </x-atoms.button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Form Modal --}}
    <x-molecules.modal wire:model="showFormModal" max-width="4xl">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-information-circle class="w-6 h-6 text-white" />
                </div>
                <h2 class="text-2xl font-bold text-white">{{ $editingId ? 'Edit About Section' : 'Add New About Section' }}</h2>
            </div>

            <form wire:submit="save" class="space-y-6">
                <x-atoms.input
                    type="text"
                    wire:model="title"
                    label="Title *"
                    placeholder="e.g., About Us"
                    :error="$errors->first('title')"
                    required
                />

                <x-atoms.textarea
                    wire:model="description1"
                    label="Description 1 *"
                    placeholder="First paragraph of description (HTML allowed)"
                    :error="$errors->first('description1')"
                    rows="4"
                    required
                />

                <x-atoms.textarea
                    wire:model="description2"
                    label="Description 2"
                    placeholder="Second paragraph of description (optional)"
                    :error="$errors->first('description2')"
                    rows="3"
                />

                <div x-data="fileInputData">
                    <x-atoms.file-input
                        wire:model="image"
                        accept="image/*"
                        :label="(!$editingId ? 'Image *' : 'Image')"
                        :error="$errors->first('image')"
                        id="about-image-input"
                        :required="!$editingId"
                    >
                        <x-slot:help>
                            <p class="text-xs text-gray-500 mt-1">Upload an image for this section (Max 2MB)</p>
                        </x-slot:help>
                        <x-slot:preview>
                            @if ($image)
                                <div class="relative group inline-block">
                                    <img src="{{ $image->temporaryUrl() }}" class="h-48 w-auto object-cover rounded-xl border-2 border-amber-500/50 shadow-lg">
                                </div>
                            @elseif ($currentImagePath)
                                <div class="relative group inline-block">
                                    <img src="{{ asset('storage/'.$currentImagePath) }}" class="h-48 w-auto object-cover rounded-xl border-2 border-gray-600 shadow-lg">
                                    <p class="text-xs text-gray-400 mt-2">Current image</p>
                                </div>
                            @endif
                        </x-slot:preview>
                    </x-atoms.file-input>
                </div>

                {{-- Features Section --}}
                <div class="border-t border-gray-700 pt-6">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        <x-heroicon-o-sparkles class="w-5 h-5 text-amber-500" />
                        Features (Optional)
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Feature 1 --}}
                        <div class="space-y-3 p-4 bg-gray-900/50 rounded-xl border border-gray-700">
                            <h4 class="text-sm font-semibold text-amber-500">Feature 1</h4>
                            <x-atoms.input
                                type="text"
                                wire:model="feature1Title"
                                label="Title"
                                placeholder="e.g., Premium Quality"
                                :error="$errors->first('feature1Title')"
                            />
                            <x-atoms.input
                                type="text"
                                wire:model="feature1Description"
                                label="Description"
                                placeholder="Short description"
                                :error="$errors->first('feature1Description')"
                            />
                            <div>
                                <x-atoms.select
                                    wire:model.live="feature1Icon"
                                    label="Icon"
                                    :options="$this->getAvailableIcons()"
                                    placeholder="Select an icon"
                                    :error="$errors->first('feature1Icon')"
                                />
                                @if($feature1Icon)
                                    <div class="mt-2 flex items-center gap-2 text-sm text-gray-400">
                                        <span>Preview:</span>
                                        <div class="w-8 h-8 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                            <x-dynamic-component :component="'heroicon-o-'.$feature1Icon" class="w-5 h-5 text-amber-500" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Feature 2 --}}
                        <div class="space-y-3 p-4 bg-gray-900/50 rounded-xl border border-gray-700">
                            <h4 class="text-sm font-semibold text-amber-500">Feature 2</h4>
                            <x-atoms.input
                                type="text"
                                wire:model="feature2Title"
                                label="Title"
                                placeholder="e.g., Best Prices"
                                :error="$errors->first('feature2Title')"
                            />
                            <x-atoms.input
                                type="text"
                                wire:model="feature2Description"
                                label="Description"
                                placeholder="Short description"
                                :error="$errors->first('feature2Description')"
                            />
                            <div>
                                <x-atoms.select
                                    wire:model.live="feature2Icon"
                                    label="Icon"
                                    :options="$this->getAvailableIcons()"
                                    placeholder="Select an icon"
                                    :error="$errors->first('feature2Icon')"
                                />
                                @if($feature2Icon)
                                    <div class="mt-2 flex items-center gap-2 text-sm text-gray-400">
                                        <span>Preview:</span>
                                        <div class="w-8 h-8 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                            <x-dynamic-component :component="'heroicon-o-'.$feature2Icon" class="w-5 h-5 text-amber-500" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Feature 3 --}}
                        <div class="space-y-3 p-4 bg-gray-900/50 rounded-xl border border-gray-700">
                            <h4 class="text-sm font-semibold text-amber-500">Feature 3</h4>
                            <x-atoms.input
                                type="text"
                                wire:model="feature3Title"
                                label="Title"
                                placeholder="e.g., Fast Delivery"
                                :error="$errors->first('feature3Title')"
                            />
                            <x-atoms.input
                                type="text"
                                wire:model="feature3Description"
                                label="Description"
                                placeholder="Short description"
                                :error="$errors->first('feature3Description')"
                            />
                            <div>
                                <x-atoms.select
                                    wire:model.live="feature3Icon"
                                    label="Icon"
                                    :options="$this->getAvailableIcons()"
                                    placeholder="Select an icon"
                                    :error="$errors->first('feature3Icon')"
                                />
                                @if($feature3Icon)
                                    <div class="mt-2 flex items-center gap-2 text-sm text-gray-400">
                                        <span>Preview:</span>
                                        <div class="w-8 h-8 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                            <x-dynamic-component :component="'heroicon-o-'.$feature3Icon" class="w-5 h-5 text-amber-500" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Feature 4 --}}
                        <div class="space-y-3 p-4 bg-gray-900/50 rounded-xl border border-gray-700">
                            <h4 class="text-sm font-semibold text-amber-500">Feature 4</h4>
                            <x-atoms.input
                                type="text"
                                wire:model="feature4Title"
                                label="Title"
                                placeholder="e.g., Expert Care"
                                :error="$errors->first('feature4Title')"
                            />
                            <x-atoms.input
                                type="text"
                                wire:model="feature4Description"
                                label="Description"
                                placeholder="Short description"
                                :error="$errors->first('feature4Description')"
                            />
                            <div>
                                <x-atoms.select
                                    wire:model.live="feature4Icon"
                                    label="Icon"
                                    :options="$this->getAvailableIcons()"
                                    placeholder="Select an icon"
                                    :error="$errors->first('feature4Icon')"
                                />
                                @if($feature4Icon)
                                    <div class="mt-2 flex items-center gap-2 text-sm text-gray-400">
                                        <span>Preview:</span>
                                        <div class="w-8 h-8 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                            <x-dynamic-component :component="'heroicon-o-'.$feature4Icon" class="w-5 h-5 text-amber-500" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input
                            type="checkbox"
                            wire:model="isActive"
                            class="w-5 h-5 rounded border-gray-600 bg-gray-700 text-amber-500 focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                        <span class="text-sm font-medium text-gray-300 group-hover:text-white transition">Active</span>
                    </label>
                    <p class="text-xs text-amber-500 mt-1 ml-8">
                        <span class="font-semibold">Note:</span> Only one section can be active at a time. Activating this will deactivate all other sections.
                    </p>
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-700">
                    <x-atoms.button type="submit" variant="secondary" icon="check">
                        {{ $editingId ? 'Update Section' : 'Create Section' }}
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
                    <h2 class="text-xl font-bold text-white">Delete About Section</h2>
                    <p class="text-sm text-gray-400 mt-1">This action cannot be undone</p>
                </div>
            </div>

            <p class="text-gray-300 mb-6">
                Are you sure you want to delete this about section? All associated data will be permanently removed.
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
