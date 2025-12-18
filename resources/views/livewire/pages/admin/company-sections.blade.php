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

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Company Profile Sections</h1>
        <p class="text-sm sm:text-base text-gray-400">Manage About, Farm, and Quality Control sections (3 sections only)</p>
    </div>

    {{-- 3 Fixed Section Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
        {{-- About Section Card --}}
        <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl hover:border-blue-500/50 transition">
            <div class="aspect-video relative overflow-hidden bg-gray-700">
                @if($aboutSection && $aboutSection->images && count($aboutSection->images) > 0)
                    <img
                        src="{{ asset('storage/' . $aboutSection->images[0]['path']) }}"
                        alt="About"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                        <x-heroicon-o-information-circle class="w-20 h-20 text-white/30" />
                    </div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <h3 class="text-white font-bold text-lg mb-1">About Section</h3>
                        <p class="text-gray-300 text-sm">Company profile information</p>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            @if($aboutSection)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full {{ $aboutSection->is_active ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                                    @if($aboutSection->is_active)
                                        <x-heroicon-o-check-circle class="w-3 h-3" />
                                        Active
                                    @else
                                        <x-heroicon-o-x-circle class="w-3 h-3" />
                                        Inactive
                                    @endif
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-900/80 text-blue-300">
                                    @if($aboutSection->image_layout === 'grid')
                                        <x-heroicon-o-squares-2x2 class="w-3 h-3" />
                                        Grid
                                    @else
                                        <x-heroicon-o-photo class="w-3 h-3" />
                                        Slider
                                    @endif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-700/80 text-gray-400">
                                    <x-heroicon-o-x-circle class="w-3 h-3" />
                                    Not Created
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 flex gap-2">
                @if($aboutSection)
                    <x-atoms.button
                        wire:click="edit({{ $aboutSection->id }})"
                        variant="primary"
                        icon="pencil"
                        size="sm"
                        class="flex-1"
                    >
                        Edit
                    </x-atoms.button>
                    <x-atoms.button
                        wire:click="confirmDelete({{ $aboutSection->id }})"
                        variant="outline"
                        icon="trash"
                        size="sm"
                        class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10"
                    >
                        <span class="hidden sm:inline">Delete</span>
                        <span class="sm:hidden"><x-heroicon-o-trash class="w-4 h-4" /></span>
                    </x-atoms.button>
                @else
                    <x-atoms.button
                        wire:click="openCreateModal('about')"
                        variant="secondary"
                        icon="plus"
                        size="sm"
                        class="w-full"
                    >
                        Create Section
                    </x-atoms.button>
                @endif
            </div>
        </div>

        {{-- Farm Section Card --}}
        <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl hover:border-amber-500/50 transition">
            <div class="aspect-video relative overflow-hidden bg-gray-700">
                @if($farmSection && $farmSection->images && count($farmSection->images) > 0)
                    <img
                        src="{{ asset('storage/' . $farmSection->images[0]['path']) }}"
                        alt="Farm"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full bg-gradient-to-br from-amber-600 to-amber-800 flex items-center justify-center">
                        <x-heroicon-o-home class="w-20 h-20 text-white/30" />
                    </div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <h3 class="text-white font-bold text-lg mb-1">Farm Section</h3>
                        <p class="text-gray-300 text-sm">Facilities & infrastructure</p>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            @if($farmSection)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full {{ $farmSection->is_active ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                                    @if($farmSection->is_active)
                                        <x-heroicon-o-check-circle class="w-3 h-3" />
                                        Active
                                    @else
                                        <x-heroicon-o-x-circle class="w-3 h-3" />
                                        Inactive
                                    @endif
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-900/80 text-blue-300">
                                    @if($farmSection->image_layout === 'grid')
                                        <x-heroicon-o-squares-2x2 class="w-3 h-3" />
                                        Grid
                                    @else
                                        <x-heroicon-o-photo class="w-3 h-3" />
                                        Slider
                                    @endif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-700/80 text-gray-400">
                                    <x-heroicon-o-x-circle class="w-3 h-3" />
                                    Not Created
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 flex gap-2">
                @if($farmSection)
                    <x-atoms.button
                        wire:click="edit({{ $farmSection->id }})"
                        variant="primary"
                        icon="pencil"
                        size="sm"
                        class="flex-1"
                    >
                        Edit
                    </x-atoms.button>
                    <x-atoms.button
                        wire:click="confirmDelete({{ $farmSection->id }})"
                        variant="outline"
                        icon="trash"
                        size="sm"
                        class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10"
                    >
                        <span class="hidden sm:inline">Delete</span>
                        <span class="sm:hidden"><x-heroicon-o-trash class="w-4 h-4" /></span>
                    </x-atoms.button>
                @else
                    <x-atoms.button
                        wire:click="openCreateModal('farm')"
                        variant="secondary"
                        icon="plus"
                        size="sm"
                        class="w-full"
                    >
                        Create Section
                    </x-atoms.button>
                @endif
            </div>
        </div>

        {{-- Quality Section Card --}}
        <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl hover:border-green-500/50 transition">
            <div class="aspect-video relative overflow-hidden bg-gray-700">
                @if($qualitySection && $qualitySection->images && count($qualitySection->images) > 0)
                    <img
                        src="{{ asset('storage/' . $qualitySection->images[0]['path']) }}"
                        alt="Quality"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center">
                        <x-heroicon-o-shield-check class="w-20 h-20 text-white/30" />
                    </div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <h3 class="text-white font-bold text-lg mb-1">Quality Control</h3>
                        <p class="text-gray-300 text-sm">Standards & process</p>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            @if($qualitySection)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full {{ $qualitySection->is_active ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                                    @if($qualitySection->is_active)
                                        <x-heroicon-o-check-circle class="w-3 h-3" />
                                        Active
                                    @else
                                        <x-heroicon-o-x-circle class="w-3 h-3" />
                                        Inactive
                                    @endif
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-900/80 text-blue-300">
                                    @if($qualitySection->image_layout === 'grid')
                                        <x-heroicon-o-squares-2x2 class="w-3 h-3" />
                                        Grid
                                    @else
                                        <x-heroicon-o-photo class="w-3 h-3" />
                                        Slider
                                    @endif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-700/80 text-gray-400">
                                    <x-heroicon-o-x-circle class="w-3 h-3" />
                                    Not Created
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 flex gap-2">
                @if($qualitySection)
                    <x-atoms.button
                        wire:click="edit({{ $qualitySection->id }})"
                        variant="primary"
                        icon="pencil"
                        size="sm"
                        class="flex-1"
                    >
                        Edit
                    </x-atoms.button>
                    <x-atoms.button
                        wire:click="confirmDelete({{ $qualitySection->id }})"
                        variant="outline"
                        icon="trash"
                        size="sm"
                        class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10"
                    >
                        <span class="hidden sm:inline">Delete</span>
                        <span class="sm:hidden"><x-heroicon-o-trash class="w-4 h-4" /></span>
                    </x-atoms.button>
                @else
                    <x-atoms.button
                        wire:click="openCreateModal('quality')"
                        variant="secondary"
                        icon="plus"
                        size="sm"
                        class="w-full"
                    >
                        Create Section
                    </x-atoms.button>
                @endif
            </div>
        </div>
    </div>

    {{-- Form Modal --}}
    <x-molecules.modal wire:model="showFormModal" max-width="4xl">
        <div class="p-4 sm:p-8">
            <div class="flex items-center gap-3 mb-6 sm:mb-8">
                @php
                    $icon = match($type) {
                        'about' => 'information-circle',
                        'farm' => 'home',
                        'quality' => 'shield-check',
                        default => 'building-office'
                    };
                    $color = match($type) {
                        'about' => 'from-blue-500 to-blue-600',
                        'farm' => 'from-amber-500 to-amber-600',
                        'quality' => 'from-green-500 to-green-600',
                        default => 'from-amber-500 to-amber-600'
                    };
                @endphp
                <div class="w-10 h-10 bg-gradient-to-br {{ $color }} rounded-xl flex items-center justify-center">
                    @if($type === 'about')
                        <x-heroicon-o-information-circle class="w-6 h-6 text-white" />
                    @elseif($type === 'farm')
                        <x-heroicon-o-home class="w-6 h-6 text-white" />
                    @elseif($type === 'quality')
                        <x-heroicon-o-shield-check class="w-6 h-6 text-white" />
                    @endif
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-white">{{ $editingId ? 'Edit' : 'Create' }} {{ ucfirst($type) }} Section</h2>
                    <p class="text-sm text-gray-400">Configure section content and images</p>
                </div>
            </div>

            <form wire:submit="save" class="space-y-6">
                {{-- Basic Info --}}
                <x-atoms.input
                    type="text"
                    wire:model="title"
                    label="Section Title *"
                    placeholder="Enter section title"
                    :error="$errors->first('title')"
                    required
                />

                <x-atoms.input
                    type="text"
                    wire:model="subtitle"
                    label="Subtitle"
                    placeholder="Enter subtitle (optional)"
                    :error="$errors->first('subtitle')"
                />

                {{-- Image Layout Selection --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-3">Image Display Style *</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative flex items-center justify-center p-4 border-2 rounded-xl cursor-pointer transition {{ $imageLayout === 'slider' ? 'border-amber-500 bg-amber-500/10' : 'border-gray-600 bg-gray-700/50 hover:border-gray-500' }}">
                            <input type="radio" wire:model.live="imageLayout" value="slider" class="sr-only">
                            <div class="text-center">
                                <x-heroicon-o-photo class="w-8 h-8 mx-auto mb-2 {{ $imageLayout === 'slider' ? 'text-amber-500' : 'text-gray-400' }}" />
                                <span class="text-sm font-semibold {{ $imageLayout === 'slider' ? 'text-amber-500' : 'text-gray-300' }}">Slider</span>
                                <p class="text-xs text-gray-500 mt-1">Auto-rotating carousel</p>
                            </div>
                        </label>

                        <label class="relative flex items-center justify-center p-4 border-2 rounded-xl cursor-pointer transition {{ $imageLayout === 'grid' ? 'border-amber-500 bg-amber-500/10' : 'border-gray-600 bg-gray-700/50 hover:border-gray-500' }}">
                            <input type="radio" wire:model.live="imageLayout" value="grid" class="sr-only">
                            <div class="text-center">
                                <x-heroicon-o-squares-2x2 class="w-8 h-8 mx-auto mb-2 {{ $imageLayout === 'grid' ? 'text-amber-500' : 'text-gray-400' }}" />
                                <span class="text-sm font-semibold {{ $imageLayout === 'grid' ? 'text-amber-500' : 'text-gray-300' }}">Grid</span>
                                <p class="text-xs text-gray-500 mt-1">Static grid layout</p>
                            </div>
                        </label>
                    </div>
                    @error('imageLayout')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Images (Max 3) --}}
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-medium text-gray-300">Images (Max 3)</label>
                        <span class="text-xs text-gray-500">Upload up to 3 images</span>
                    </div>

                    {{-- Image 1 --}}
                    <div x-data="fileInputData">
                        <x-atoms.file-input
                            wire:model="image1"
                            accept="image/*"
                            label="Image 1"
                            :error="$errors->first('image1')"
                            id="image1-input"
                        >
                            <x-slot:preview>
                                @if ($image1)
                                    <div class="relative group inline-block mt-2">
                                        <img src="{{ $image1->temporaryUrl() }}" class="h-32 w-auto object-cover rounded-xl border-2 border-amber-500/50 shadow-lg">
                                    </div>
                                @elseif($currentImage1Path)
                                    <div class="relative group inline-block mt-2">
                                        <img src="{{ asset('storage/' . $currentImage1Path) }}" class="h-32 w-auto object-cover rounded-xl border-2 border-gray-600 shadow-lg">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                            <span class="text-white text-xs">Current Image</span>
                                        </div>
                                    </div>
                                @endif
                            </x-slot:preview>
                        </x-atoms.file-input>
                    </div>

                    {{-- Image 2 --}}
                    <div x-data="fileInputData">
                        <x-atoms.file-input
                            wire:model="image2"
                            accept="image/*"
                            label="Image 2 (Optional)"
                            :error="$errors->first('image2')"
                            id="image2-input"
                        >
                            <x-slot:preview>
                                @if ($image2)
                                    <div class="relative group inline-block mt-2">
                                        <img src="{{ $image2->temporaryUrl() }}" class="h-32 w-auto object-cover rounded-xl border-2 border-amber-500/50 shadow-lg">
                                    </div>
                                @elseif($currentImage2Path)
                                    <div class="relative group inline-block mt-2">
                                        <img src="{{ asset('storage/' . $currentImage2Path) }}" class="h-32 w-auto object-cover rounded-xl border-2 border-gray-600 shadow-lg">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                            <span class="text-white text-xs">Current Image</span>
                                        </div>
                                    </div>
                                @endif
                            </x-slot:preview>
                        </x-atoms.file-input>
                    </div>

                    {{-- Image 3 --}}
                    <div x-data="fileInputData">
                        <x-atoms.file-input
                            wire:model="image3"
                            accept="image/*"
                            label="Image 3 (Optional)"
                            :error="$errors->first('image3')"
                            id="image3-input"
                        >
                            <x-slot:preview>
                                @if ($image3)
                                    <div class="relative group inline-block mt-2">
                                        <img src="{{ $image3->temporaryUrl() }}" class="h-32 w-auto object-cover rounded-xl border-2 border-amber-500/50 shadow-lg">
                                    </div>
                                @elseif($currentImage3Path)
                                    <div class="relative group inline-block mt-2">
                                        <img src="{{ asset('storage/' . $currentImage3Path) }}" class="h-32 w-auto object-cover rounded-xl border-2 border-gray-600 shadow-lg">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                            <span class="text-white text-xs">Current Image</span>
                                        </div>
                                    </div>
                                @endif
                            </x-slot:preview>
                        </x-atoms.file-input>
                    </div>
                </div>

                {{-- Content Blocks --}}
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-medium text-gray-300">Content Blocks</label>
                        <x-atoms.button
                            type="button"
                            wire:click="addContentBlock"
                            variant="outline"
                            icon="plus"
                            size="sm"
                        >
                            Add Block
                        </x-atoms.button>
                    </div>

                    @if(count($contentBlocks) === 0)
                        <div class="bg-gray-900/50 rounded-xl p-6 border border-gray-700 text-center">
                            <x-heroicon-o-document-text class="w-12 h-12 mx-auto text-gray-500 mb-2" />
                            <p class="text-sm text-gray-400">No content blocks yet. Click "Add Block" to create one.</p>
                        </div>
                    @endif

                    @foreach($contentBlocks as $index => $block)
                        <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700 space-y-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-amber-500">Block {{ $index + 1 }}</span>
                                <button
                                    type="button"
                                    wire:click="removeContentBlock({{ $index }})"
                                    class="text-red-400 hover:text-red-300 text-sm flex items-center gap-1"
                                >
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                    <span class="hidden sm:inline">Remove</span>
                                </button>
                            </div>

                            <x-atoms.input
                                type="text"
                                wire:model="contentBlocks.{{ $index }}.title"
                                label="Block Title *"
                                placeholder="e.g., Strategic Location"
                                :error="$errors->first('contentBlocks.'.$index.'.title')"
                                required
                            />

                            <x-atoms.textarea
                                wire:model="contentBlocks.{{ $index }}.description"
                                label="Block Description *"
                                placeholder="Enter block description"
                                :error="$errors->first('contentBlocks.'.$index.'.description')"
                                rows="3"
                                required
                            />
                        </div>
                    @endforeach
                </div>

                {{-- Process Steps (Only for Quality) --}}
                @if($type === 'quality')
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-300">Quality Process Steps</label>
                            <x-atoms.button
                                type="button"
                                wire:click="addProcessStep"
                                variant="outline"
                                icon="plus"
                                size="sm"
                            >
                                Add Step
                            </x-atoms.button>
                        </div>

                        @if(count($processSteps) === 0)
                            <div class="bg-gray-900/50 rounded-xl p-6 border border-gray-700 text-center">
                                <x-heroicon-o-list-bullet class="w-12 h-12 mx-auto text-gray-500 mb-2" />
                                <p class="text-sm text-gray-400">No process steps yet. Click "Add Step" to create one.</p>
                            </div>
                        @endif

                        @foreach($processSteps as $index => $step)
                            <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700 space-y-3">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-semibold text-amber-500">Step {{ $step['number'] }}</span>
                                    <button
                                        type="button"
                                        wire:click="removeProcessStep({{ $index }})"
                                        class="text-red-400 hover:text-red-300 text-sm flex items-center gap-1"
                                    >
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                        <span class="hidden sm:inline">Remove</span>
                                    </button>
                                </div>

                                <x-atoms.input
                                    type="text"
                                    wire:model="processSteps.{{ $index }}.title"
                                    label="Step Title"
                                    placeholder="e.g., Initial Selection"
                                    :error="$errors->first('processSteps.'.$index.'.title')"
                                />

                                <x-atoms.textarea
                                    wire:model="processSteps.{{ $index }}.description"
                                    label="Step Description"
                                    placeholder="Describe this step"
                                    :error="$errors->first('processSteps.'.$index.'.description')"
                                    rows="2"
                                />
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Active Status --}}
                <div>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input
                            type="checkbox"
                            wire:model="isActive"
                            class="w-5 h-5 rounded border-gray-600 bg-gray-700 text-amber-500 focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                        <span class="text-sm font-medium text-gray-300 group-hover:text-white transition">Active</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1 ml-8">Display this section on the company profile page</p>
                </div>

                <div class="flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t border-gray-700">
                    <x-atoms.button type="button" wire:click="cancelEdit" variant="outline" icon="x-mark" class="w-full sm:w-auto">
                        Cancel
                    </x-atoms.button>

                    <x-atoms.button type="submit" variant="secondary" icon="check" class="w-full sm:w-auto">
                        {{ $editingId ? 'Update Section' : 'Create Section' }}
                    </x-atoms.button>
                </div>
            </form>
        </div>
    </x-molecules.modal>

    {{-- Delete Confirmation Modal --}}
    <x-molecules.modal wire:model="showDeleteModal" max-width="md">
        <div class="p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-red-600/20 rounded-xl flex items-center justify-center">
                    <x-heroicon-o-exclamation-triangle class="w-7 h-7 text-red-400" />
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Delete Section</h2>
                    <p class="text-sm text-gray-400 mt-1">This action cannot be undone</p>
                </div>
            </div>

            <p class="text-gray-300 mb-6">
                Are you sure you want to delete this section? All associated data will be permanently removed.
            </p>

            <div class="flex flex-col-reverse sm:flex-row gap-3">
                <x-atoms.button wire:click="$set('showDeleteModal', false)" variant="outline" icon="x-mark" class="w-full sm:w-auto">
                    Cancel
                </x-atoms.button>

                <x-atoms.button wire:click="delete" variant="outline" icon="trash" class="!text-red-400 !border-red-500/50 hover:!bg-red-500/10 w-full sm:w-auto">
                    Delete
                </x-atoms.button>
            </div>
        </div>
    </x-molecules.modal>
</div>
