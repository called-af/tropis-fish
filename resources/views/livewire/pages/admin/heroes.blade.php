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
            x-init="setTimeout(() => show = false, 5000)"
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
            <h1 class="text-3xl font-bold text-white mb-2">Hero Slider Management</h1>
            <p class="text-gray-400">Manage your hero slider images (Maximum 3 slides)</p>
        </div>
        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
            Add Hero
        </x-atoms.button>
    </div>

    {{-- Search Section --}}
    <div class="mb-8">
        <x-atoms.search-input
            wire:model.live="search"
            placeholder="Search heroes by title..."
        />
    </div>

    {{-- Hero Grid --}}
    @if($heroes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($heroes as $hero)
                <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl hover:border-amber-500/50 transition">
                    {{-- Image --}}
                    <div class="aspect-video relative overflow-hidden">
                        <img
                            src="{{ asset("storage/{$hero->image_path}") }}"
                            alt="{{ $hero->title }}"
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="text-white font-bold text-lg line-clamp-1 mb-1">{{ $hero->title }}</h3>
                                @if($hero->description)
                                    <p class="text-gray-300 text-sm line-clamp-2">{{ $hero->description }}</p>
                                @endif
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-700/80 text-gray-300">
                                        <x-heroicon-o-numbered-list class="w-3 h-3 text-amber-500" />
                                        Order: {{ $hero->order }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full {{ $hero->is_active ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                                        @if($hero->is_active)
                                            <x-heroicon-o-check-circle class="w-3 h-3" />
                                            Active
                                        @else
                                            <x-heroicon-o-x-circle class="w-3 h-3" />
                                            Inactive
                                        @endif
                                    </span>
                                    @if($hero->background_type === 'youtube')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-red-900/80 text-red-300">
                                            <x-heroicon-o-play-circle class="w-3 h-3" />
                                            YouTube
                                        </span>
                                    @elseif($hero->background_type === 'video')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-purple-900/80 text-purple-300">
                                            <x-heroicon-o-video-camera class="w-3 h-3" />
                                            Video
                                        </span>
                                    @elseif($hero->background_type === 'image')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-900/80 text-blue-300">
                                            <x-heroicon-o-photo class="w-3 h-3" />
                                            Image
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="p-4 flex gap-2">
                        <x-atoms.button
                            wire:click="edit({{ $hero->id }})"
                            variant="primary"
                            icon="pencil"
                            size="sm"
                            class="flex-1"
                        >
                            Edit
                        </x-atoms.button>
                        <x-atoms.button
                            wire:click="confirmDelete({{ $hero->id }})"
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
        @if($heroes->hasPages())
            <div class="flex justify-center">
                {{ $heroes->links() }}
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
                    <h3 class="text-lg font-semibold text-white mb-1">No heroes found</h3>
                    <p class="text-sm text-gray-400 mb-4">
                        @if($search)
                            No results for "{{ $search }}". Try a different search term.
                        @else
                            Create your first hero slider to get started
                        @endif
                    </p>
                    @if(!$search)
                        <x-atoms.button wire:click="openCreateModal" variant="secondary" icon="plus">
                            Add Hero
                        </x-atoms.button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Form Modal --}}
    <x-molecules.modal wire:model="showFormModal" max-width="3xl">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-photo class="w-6 h-6 text-white" />
                </div>
                <h2 class="text-2xl font-bold text-white">{{ $editingId ? 'Edit Hero' : 'Add New Hero' }}</h2>
            </div>

            <form wire:submit="save" class="space-y-6">
                <x-atoms.input
                    type="text"
                    wire:model="title"
                    label="Title *"
                    placeholder="Enter hero title"
                    :error="$errors->first('title')"
                    required
                />

                <x-atoms.textarea
                    wire:model="description"
                    label="Description"
                    placeholder="Enter hero description (optional)"
                    :error="$errors->first('description')"
                    rows="3"
                />

                {{-- Background Type Selection --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-3">Background Type *</label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="relative flex items-center justify-center p-4 border-2 rounded-xl cursor-pointer transition {{ $backgroundType === 'image' ? 'border-amber-500 bg-amber-500/10' : 'border-gray-600 bg-gray-700/50 hover:border-gray-500' }}">
                            <input type="radio" wire:model.live="backgroundType" value="image" class="sr-only">
                            <div class="text-center">
                                <x-heroicon-o-photo class="w-8 h-8 mx-auto mb-2 {{ $backgroundType === 'image' ? 'text-amber-500' : 'text-gray-400' }}" />
                                <span class="text-sm font-semibold {{ $backgroundType === 'image' ? 'text-amber-500' : 'text-gray-300' }}">Image Only</span>
                            </div>
                        </label>

                        <label class="relative flex items-center justify-center p-4 border-2 rounded-xl cursor-pointer transition {{ $backgroundType === 'video' ? 'border-amber-500 bg-amber-500/10' : 'border-gray-600 bg-gray-700/50 hover:border-gray-500' }}">
                            <input type="radio" wire:model.live="backgroundType" value="video" class="sr-only">
                            <div class="text-center">
                                <x-heroicon-o-video-camera class="w-8 h-8 mx-auto mb-2 {{ $backgroundType === 'video' ? 'text-amber-500' : 'text-gray-400' }}" />
                                <span class="text-sm font-semibold {{ $backgroundType === 'video' ? 'text-amber-500' : 'text-gray-300' }}">Upload Video</span>
                            </div>
                        </label>

                        <label class="relative flex items-center justify-center p-4 border-2 rounded-xl cursor-pointer transition {{ $backgroundType === 'youtube' ? 'border-amber-500 bg-amber-500/10' : 'border-gray-600 bg-gray-700/50 hover:border-gray-500' }}">
                            <input type="radio" wire:model.live="backgroundType" value="youtube" class="sr-only">
                            <div class="text-center">
                                <x-heroicon-o-play-circle class="w-8 h-8 mx-auto mb-2 {{ $backgroundType === 'youtube' ? 'text-amber-500' : 'text-gray-400' }}" />
                                <span class="text-sm font-semibold {{ $backgroundType === 'youtube' ? 'text-amber-500' : 'text-gray-300' }}">YouTube</span>
                            </div>
                        </label>
                    </div>
                    @error('backgroundType')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image Upload (Required only for Image type) --}}
                @if($backgroundType === 'image')
                    <div x-data="fileInputData">
                        <x-atoms.file-input
                            wire:model="image"
                            accept="image/*"
                            :label="(!$editingId ? 'Background Image *' : 'Background Image')"
                            :error="$errors->first('image')"
                            id="hero-image-input"
                            :required="!$editingId"
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">This will be the main background</p>
                            </x-slot:help>
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
                @endif

                {{-- YouTube URL Field (Only when YouTube is selected) --}}
                @if($backgroundType === 'youtube')
                    <x-atoms.input
                        type="url"
                        wire:model="youtubeUrl"
                        label="YouTube Video URL *"
                        placeholder="https://youtu.be/VIDEO_ID or https://www.youtube.com/watch?v=VIDEO_ID"
                        :error="$errors->first('youtubeUrl')"
                        required
                    >
                        <x-slot:help>
                            <p class="text-xs text-gray-500 mt-1">Paste any YouTube video link (youtu.be, youtube.com/watch, youtube.com/embed)</p>
                        </x-slot:help>
                    </x-atoms.input>
                @endif

                {{-- Video Upload Field (Only when Video is selected) --}}
                @if($backgroundType === 'video')
                    <div x-data="fileInputData">
                        <x-atoms.file-input
                            wire:model="video"
                            accept="video/*"
                            label="Background Video *"
                            :error="$errors->first('video')"
                            id="hero-video-input"
                            required
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">Max 50MB - MP4, MOV, AVI, WMV</p>
                            </x-slot:help>
                        </x-atoms.file-input>
                    </div>
                @endif

                <div>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input
                            type="checkbox"
                            wire:model="isActive"
                            class="w-5 h-5 rounded border-gray-600 bg-gray-700 text-amber-500 focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                        <span class="text-sm font-medium text-gray-300 group-hover:text-white transition">Active</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1 ml-8">Display this hero on the website</p>
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-700">
                    <x-atoms.button type="submit" variant="secondary" icon="check">
                        {{ $editingId ? 'Update Hero' : 'Create Hero' }}
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
                    <h2 class="text-xl font-bold text-white">Delete Hero</h2>
                    <p class="text-sm text-gray-400 mt-1">This action cannot be undone</p>
                </div>
            </div>

            <p class="text-gray-300 mb-6">
                Are you sure you want to delete this hero? All associated data will be permanently removed.
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
