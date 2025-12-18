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

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Footer Management</h1>
        <p class="text-gray-400">Manage all footer sections including company info, menu links, information, and social media</p>
    </div>

    {{-- Grid of Footer Sections --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        {{-- Company Info Section --}}
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl border border-gray-700 p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-building-office class="w-6 h-6 text-white" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Company Info</h3>
                        <p class="text-sm text-gray-400">Description and copyright text</p>
                    </div>
                </div>
                @if($companySection)
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $companySection->is_active ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                        {{ $companySection->is_active ? 'Active' : 'Inactive' }}
                    </span>
                @else
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-700/80 text-gray-400">Not Created</span>
                @endif
            </div>

            @if($companySection)
                <div class="mb-4 p-4 bg-gray-900/50 rounded-lg">
                    <p class="text-sm text-gray-300 mb-2"><span class="font-semibold text-amber-500">Description:</span></p>
                    <p class="text-sm text-gray-400">{{ Str::limit($companySection->description, 100) }}</p>
                    <p class="text-sm text-gray-300 mt-3 mb-1"><span class="font-semibold text-amber-500">Copyright:</span></p>
                    <p class="text-sm text-gray-400">{{ $companySection->copyright_text }}</p>
                </div>
            @endif

            <x-atoms.button
                wire:click="openModal('company')"
                variant="secondary"
                icon="pencil"
                size="sm"
                class="w-full"
            >
                {{ $companySection ? 'Edit Company Info' : 'Create Company Info' }}
            </x-atoms.button>
        </div>

        {{-- Menu Section --}}
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl border border-gray-700 p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-bars-3 class="w-6 h-6 text-white" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Menu Section</h3>
                        <p class="text-sm text-gray-400">Navigation links</p>
                    </div>
                </div>
                @if($menuSection)
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $menuSection->is_active ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                        {{ $menuSection->is_active ? 'Active' : 'Inactive' }}
                    </span>
                @else
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-700/80 text-gray-400">Not Created</span>
                @endif
            </div>

            @if($menuSection)
                <div class="mb-4 space-y-2">
                    @foreach($menuSection->links as $link)
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <x-heroicon-o-link class="w-4 h-4 text-blue-500" />
                            <span class="text-white">{{ $link['text'] }}</span>
                            <span class="text-gray-600">→</span>
                            <span class="text-gray-500">{{ $link['url'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <x-atoms.button
                wire:click="openModal('menu')"
                variant="secondary"
                icon="pencil"
                size="sm"
                class="w-full"
            >
                {{ $menuSection ? 'Edit Menu' : 'Create Menu' }}
            </x-atoms.button>
        </div>

        {{-- Information Section --}}
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl border border-gray-700 p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-information-circle class="w-6 h-6 text-white" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Information Section</h3>
                        <p class="text-sm text-gray-400">Important links and policies</p>
                    </div>
                </div>
                @if($informationSection)
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $informationSection->is_active ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                        {{ $informationSection->is_active ? 'Active' : 'Inactive' }}
                    </span>
                @else
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-700/80 text-gray-400">Not Created</span>
                @endif
            </div>

            @if($informationSection)
                <div class="mb-4 space-y-2">
                    @foreach($informationSection->links as $link)
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <x-heroicon-o-link class="w-4 h-4 text-purple-500" />
                            <span class="text-white">{{ $link['text'] }}</span>
                            <span class="text-gray-600">→</span>
                            <span class="text-gray-500">{{ $link['url'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <x-atoms.button
                wire:click="openModal('information')"
                variant="secondary"
                icon="pencil"
                size="sm"
                class="w-full"
            >
                {{ $informationSection ? 'Edit Information' : 'Create Information' }}
            </x-atoms.button>
        </div>

        {{-- Social Media Section --}}
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl border border-gray-700 p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-share class="w-6 h-6 text-white" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Social Media Section</h3>
                        <p class="text-sm text-gray-400">Social media links</p>
                    </div>
                </div>
                @if($socialSection)
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $socialSection->is_active ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                        {{ $socialSection->is_active ? 'Active' : 'Inactive' }}
                    </span>
                @else
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-700/80 text-gray-400">Not Created</span>
                @endif
            </div>

            @if($socialSection)
                <div class="mb-4 space-y-2">
                    @foreach($socialSection->links as $link)
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <x-heroicon-o-link class="w-4 h-4 text-green-500" />
                            <span class="text-white">{{ $link['text'] }}</span>
                            <span class="text-gray-600 text-xs">({{ $link['icon'] ?? 'No icon' }})</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <x-atoms.button
                wire:click="openModal('social')"
                variant="secondary"
                icon="pencil"
                size="sm"
                class="w-full"
            >
                {{ $socialSection ? 'Edit Social Media' : 'Create Social Media' }}
            </x-atoms.button>
        </div>
    </div>

    {{-- Form Modal --}}
    <x-molecules.modal wire:model="showFormModal" max-width="2xl">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-gradient-to-br {{ $type === 'company' ? 'from-amber-500 to-amber-600' : ($type === 'menu' ? 'from-blue-500 to-blue-600' : ($type === 'information' ? 'from-purple-500 to-purple-600' : 'from-green-500 to-green-600')) }} rounded-xl flex items-center justify-center">
                    @if($type === 'company')
                        <x-heroicon-o-building-office class="w-6 h-6 text-white" />
                    @elseif($type === 'menu')
                        <x-heroicon-o-bars-3 class="w-6 h-6 text-white" />
                    @elseif($type === 'information')
                        <x-heroicon-o-information-circle class="w-6 h-6 text-white" />
                    @else
                        <x-heroicon-o-share class="w-6 h-6 text-white" />
                    @endif
                </div>
                <h2 class="text-2xl font-bold text-white">Edit {{ ucfirst($type) }} Section</h2>
            </div>

            <form wire:submit="save" class="space-y-6">
                @if($type === 'company')
                    {{-- Company Info Form --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Company Description *</label>
                        <x-atoms.textarea
                            wire:model="description"
                            placeholder="Enter company description"
                            rows="3"
                            :error="$errors->first('description')"
                        />
                    </div>

                    <x-atoms.input
                        type="text"
                        wire:model="copyrightText"
                        label="Copyright Text *"
                        placeholder="e.g., All rights reserved"
                        :error="$errors->first('copyrightText')"
                        required
                    />
                @else
                    {{-- Links Form --}}
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-300">Links *</label>
                            <x-atoms.button type="button" wire:click="addLink" variant="outline" icon="plus" size="sm">
                                Add Link
                            </x-atoms.button>
                        </div>

                        @foreach($links as $index => $link)
                            <div class="p-4 bg-gray-800/50 border border-gray-700 rounded-xl space-y-3">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-semibold text-amber-500">Link #{{ $index + 1 }}</span>
                                    <button type="button" wire:click="removeLink({{ $index }})" class="text-red-400 hover:text-red-300 transition">
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                    </button>
                                </div>

                                <x-atoms.input
                                    type="text"
                                    wire:model="links.{{ $index }}.text"
                                    label="Link Text"
                                    placeholder="e.g., Home, Facebook, etc."
                                    :error="$errors->first('links.'.$index.'.text')"
                                />

                                <x-atoms.input
                                    type="text"
                                    wire:model="links.{{ $index }}.url"
                                    label="Link URL"
                                    placeholder="e.g., /, #, https://facebook.com"
                                    :error="$errors->first('links.'.$index.'.url')"
                                />

                                @if($type === 'social')
                                    <x-atoms.select
                                        wire:model="links.{{ $index }}.icon"
                                        label="Social Icon"
                                        :options="[
                                            'facebook' => 'Facebook',
                                            'twitter' => 'Twitter',
                                            'instagram' => 'Instagram',
                                            'linkedin' => 'LinkedIn',
                                            'youtube' => 'YouTube',
                                            'tiktok' => 'TikTok'
                                        ]"
                                        :error="$errors->first('links.'.$index.'.icon')"
                                    />
                                @endif
                            </div>
                        @endforeach

                        @if(count($links) === 0)
                            <div class="text-center py-8 border-2 border-dashed border-gray-700 rounded-xl">
                                <x-heroicon-o-link class="w-12 h-12 text-gray-600 mx-auto mb-2" />
                                <p class="text-gray-400 text-sm">No links added yet. Click "Add Link" to get started.</p>
                            </div>
                        @endif
                    </div>
                @endif

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
                        Save Changes
                    </x-atoms.button>

                    <x-atoms.button type="button" wire:click="cancelEdit" variant="outline" icon="x-mark">
                        Cancel
                    </x-atoms.button>
                </div>
            </form>
        </div>
    </x-molecules.modal>
</div>
