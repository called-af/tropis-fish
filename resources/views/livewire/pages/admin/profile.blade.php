<div class="max-w-4xl mx-auto">
    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="mb-6 bg-green-900/50 border border-green-700 text-green-300 px-4 sm:px-6 py-4 rounded-xl flex items-center justify-between"
            role="alert"
        >
            <div class="flex items-center gap-3">
                <x-heroicon-o-check-circle class="w-5 h-5 flex-shrink-0" />
                <span class="font-medium text-sm sm:text-base">{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="text-green-300 hover:text-green-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>
    @endif

    {{-- Profile Information Card --}}
    <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl mb-6">
        <div class="p-4 sm:p-6 md:p-8 border-b border-gray-700">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 sm:w-12 h-10 sm:h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <x-heroicon-o-user class="w-6 sm:w-7 h-6 sm:h-7 text-white" />
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-white">Profile Information</h2>
                    <p class="text-xs sm:text-sm text-gray-400">Update your account details</p>
                </div>
            </div>
        </div>

        <form wire:submit="updateProfile" class="p-4 sm:p-6 md:p-8 space-y-6">
            <x-atoms.input
                type="text"
                wire:model="name"
                label="Name *"
                placeholder="Enter your name"
                :error="$errors->first('name')"
                required
            />

            <x-atoms.input
                type="email"
                wire:model="email"
                label="Email *"
                placeholder="Enter your email"
                :error="$errors->first('email')"
                required
            />

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-700">
                <x-atoms.button type="submit" variant="secondary" icon="check" class="w-full sm:w-auto">
                    Update Profile
                </x-atoms.button>
            </div>
        </form>
    </div>

    {{-- Password Card --}}
    <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl">
        <div class="p-4 sm:p-6 md:p-8 border-b border-gray-700">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 sm:w-12 h-10 sm:h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <x-heroicon-o-lock-closed class="w-6 sm:w-7 h-6 sm:h-7 text-white" />
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-white">Change Password</h2>
                        <p class="text-xs sm:text-sm text-gray-400">Update your password to keep your account secure</p>
                    </div>
                </div>
                @if(!$showPasswordFields)
                    <x-atoms.button
                        type="button"
                        wire:click="togglePasswordFields"
                        variant="outline"
                        icon="pencil"
                        size="sm"
                        class="hidden sm:inline-flex"
                    >
                        Edit
                    </x-atoms.button>
                @endif
            </div>
        </div>

        @if(!$showPasswordFields)
            <div class="p-4 sm:p-6 md:p-8 text-center">
                <div class="flex flex-col items-center gap-4">
                    <div class="w-16 h-16 bg-gray-700/50 rounded-full flex items-center justify-center">
                        <x-heroicon-o-shield-check class="w-8 h-8 text-amber-500" />
                    </div>
                    <div>
                        <p class="text-gray-300 text-sm sm:text-base mb-4">Your password is secure</p>
                        <x-atoms.button
                            type="button"
                            wire:click="togglePasswordFields"
                            variant="secondary"
                            icon="key"
                            size="sm"
                            class="w-full sm:w-auto"
                        >
                            Change Password
                        </x-atoms.button>
                    </div>
                </div>
            </div>
        @else
            <form wire:submit="updatePassword" class="p-4 sm:p-6 md:p-8 space-y-6">
                <x-atoms.input
                    type="password"
                    wire:model="currentPassword"
                    label="Current Password *"
                    placeholder="Enter your current password"
                    :error="$errors->first('currentPassword')"
                    required
                />

                <x-atoms.input
                    type="password"
                    wire:model="newPassword"
                    label="New Password *"
                    placeholder="Enter new password (min. 8 characters)"
                    :error="$errors->first('newPassword')"
                    required
                />

                <x-atoms.input
                    type="password"
                    wire:model="newPasswordConfirmation"
                    label="Confirm New Password *"
                    placeholder="Re-enter new password"
                    :error="$errors->first('newPasswordConfirmation')"
                    required
                />

                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-700">
                    <x-atoms.button type="submit" variant="secondary" icon="check" class="w-full sm:w-auto">
                        Update Password
                    </x-atoms.button>

                    <x-atoms.button
                        type="button"
                        wire:click="togglePasswordFields"
                        variant="outline"
                        icon="x-mark"
                        class="w-full sm:w-auto"
                    >
                        Cancel
                    </x-atoms.button>
                </div>
            </form>
        @endif
    </div>
</div>
