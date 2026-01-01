<div class="max-w-4xl mx-auto">
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
        <h1 class="text-3xl font-bold text-white mb-2">Website Settings</h1>
        <p class="text-gray-400">Manage your website name, company information, and logo</p>
    </div>

    {{-- Settings Form --}}
    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-8">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                <x-heroicon-o-cog-6-tooth class="w-6 h-6 text-white" />
            </div>
            <h2 class="text-2xl font-bold text-white">General Settings</h2>
        </div>

        <form wire:submit="save" class="space-y-8">
            {{-- Website Name --}}
            <div>
                <x-atoms.input
                    type="text"
                    wire:model="websiteName"
                    label="Website Name *"
                    placeholder="e.g., PT. Tropis Fish Indonesia"
                    :error="$errors->first('websiteName')"
                    required
                >
                    <x-slot:help>
                        <p class="text-xs text-gray-500 mt-1">
                            This will appear in the browser tab and page titles
                        </p>
                    </x-slot:help>
                </x-atoms.input>
            </div>

            {{-- Company Name --}}
            <div>
                <x-atoms.input
                    type="text"
                    wire:model="companyName"
                    label="Company Name *"
                    placeholder="e.g., PT. Tropis Fish Indonesia"
                    :error="$errors->first('companyName')"
                    required
                >
                    <x-slot:help>
                        <p class="text-xs text-gray-500 mt-1">
                            This will be displayed throughout the website (navbar, footer, etc.)
                        </p>
                    </x-slot:help>
                </x-atoms.input>
            </div>

            {{-- Company Description --}}
            <div>
                <x-atoms.input
                    type="text"
                    wire:model="companyDescription"
                    label="Company Description *"
                    placeholder="e.g., Export of Ornamental Freshwater Fish"
                    :error="$errors->first('companyDescription')"
                    required
                >
                    <x-slot:help>
                        <p class="text-xs text-gray-500 mt-1">
                            Short tagline displayed below company name in navbar and footer
                        </p>
                    </x-slot:help>
                </x-atoms.input>
            </div>

            {{-- Email Configuration --}}
            <div class="pt-8 border-t border-gray-700">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-envelope class="w-6 h-6 text-white" />
                    </div>
                    <h3 class="text-xl font-bold text-white">Email Configuration (SMTP)</h3>
                </div>

                <div class="space-y-6">
                    {{-- Contact Email --}}
                    <div>
                        <x-atoms.input
                            type="email"
                            wire:model="contactEmail"
                            label="Contact Email *"
                            placeholder="e.g., sales@tropisfish.com"
                            :error="$errors->first('contactEmail')"
                            required
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">
                                    Email address where contact form submissions will be sent
                                </p>
                            </x-slot:help>
                        </x-atoms.input>
                    </div>

                    {{-- SMTP Host --}}
                    <div>
                        <x-atoms.input
                            type="text"
                            wire:model="mailHost"
                            label="SMTP Host *"
                            placeholder="e.g., smtp.gmail.com or sandbox.smtp.mailtrap.io"
                            :error="$errors->first('mailHost')"
                            required
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">
                                    SMTP server hostname (Gmail: smtp.gmail.com, Mailtrap: sandbox.smtp.mailtrap.io)
                                </p>
                            </x-slot:help>
                        </x-atoms.input>
                    </div>

                    {{-- SMTP Port --}}
                    <div>
                        <x-atoms.input
                            type="number"
                            wire:model="mailPort"
                            label="SMTP Port *"
                            placeholder="e.g., 587 or 2525"
                            :error="$errors->first('mailPort')"
                            required
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">
                                    Common ports: 587 (TLS), 465 (SSL), 2525 (Mailtrap)
                                </p>
                            </x-slot:help>
                        </x-atoms.input>
                    </div>

                    {{-- SMTP Username --}}
                    <div>
                        <x-atoms.input
                            type="text"
                            wire:model="mailUsername"
                            label="SMTP Username"
                            placeholder="Your SMTP username or email"
                            :error="$errors->first('mailUsername')"
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">
                                    Your email address or SMTP username provided by your email service
                                </p>
                            </x-slot:help>
                        </x-atoms.input>
                    </div>

                    {{-- SMTP Password --}}
                    <div>
                        <x-atoms.input
                            type="password"
                            wire:model="mailPassword"
                            label="SMTP Password"
                            placeholder="Your SMTP password or app password"
                            :error="$errors->first('mailPassword')"
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">
                                    Your email password or app-specific password (for Gmail, use App Password)
                                </p>
                            </x-slot:help>
                        </x-atoms.input>
                    </div>

                    {{-- SMTP Encryption --}}
                    <div>
                        <x-atoms.select
                            wire:model="mailEncryption"
                            label="Encryption Type *"
                            :options="['tls' => 'TLS (Recommended)', 'ssl' => 'SSL']"
                            :error="$errors->first('mailEncryption')"
                        />
                        <p class="text-xs text-gray-500 mt-1">
                            TLS is recommended for most providers (port 587)
                        </p>
                    </div>

                    {{-- Test Email Button --}}
                    <div class="pt-6 border-t border-gray-600">
                        @if (session()->has('test_email_success'))
                            <div
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 8000)"
                                class="mb-4 bg-green-900/50 border border-green-700 text-green-300 px-4 py-3 rounded-lg flex items-center justify-between"
                                role="alert"
                            >
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-check-circle class="w-5 h-5" />
                                    <span class="text-sm">{{ session('test_email_success') }}</span>
                                </div>
                                <button @click="show = false" class="text-green-300 hover:text-green-100">
                                    <x-heroicon-o-x-mark class="w-4 h-4" />
                                </button>
                            </div>
                        @endif

                        @if (session()->has('test_email_error'))
                            <div
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 10000)"
                                class="mb-4 bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded-lg flex items-center justify-between"
                                role="alert"
                            >
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-exclamation-triangle class="w-5 h-5" />
                                    <span class="text-sm">{{ session('test_email_error') }}</span>
                                </div>
                                <button @click="show = false" class="text-red-300 hover:text-red-100">
                                    <x-heroicon-o-x-mark class="w-4 h-4" />
                                </button>
                            </div>
                        @endif

                        <button
                            type="button"
                            wire:click="testEmail"
                            wire:loading.attr="disabled"
                            class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center justify-center gap-2"
                        >
                            <x-heroicon-o-paper-airplane class="w-5 h-5" wire:loading.remove wire:target="testEmail" />
                            <svg wire:loading wire:target="testEmail" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="testEmail">Send Test Email</span>
                            <span wire:loading wire:target="testEmail">Sending...</span>
                        </button>
                        <p class="text-xs text-gray-500 mt-2 text-center">
                            Send a test email to verify your SMTP configuration before saving
                        </p>
                    </div>
                </div>
            </div>

            {{-- Company Logo --}}
            <div>
                <div x-data="fileInputData">
                    <x-atoms.file-input
                        wire:model="logo"
                        accept="image/*"
                        label="Company Logo"
                        :error="$errors->first('logo')"
                        id="logo-input"
                    >
                        <x-slot:help>
                            <p class="text-xs text-gray-500 mt-1">
                                Recommended size: 200x200px or square format. Max 2MB.
                            </p>
                        </x-slot:help>

                        <x-slot:preview>
                            @if ($logo)
                                <div class="mt-4">
                                    <p class="text-xs text-gray-400 mb-2">Preview:</p>
                                    <div class="relative group inline-block">
                                        <img src="{{ $logo->temporaryUrl() }}" class="h-32 w-32 object-cover rounded-xl border-2 border-amber-500/50 shadow-lg">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    </div>
                                </div>
                            @endif
                        </x-slot:preview>
                    </x-atoms.file-input>
                </div>

                @if($this->currentLogo)
                    <div class="mt-4 p-4 bg-gray-900/50 rounded-xl border border-gray-700">
                        <p class="text-xs text-gray-400 mb-3">Current Logo:</p>
                        <img
                            src="{{ asset('storage/' . $this->currentLogo) }}"
                            alt="Current Logo"
                            class="h-32 w-32 object-cover rounded-xl border-2 border-gray-600"
                        >
                    </div>
                @else
                    <div class="mt-4 p-4 bg-gray-900/50 rounded-xl border border-gray-700">
                        <p class="text-xs text-gray-400 mb-3">Current Logo:</p>
                        <img
                            src="{{ asset('assets/logo-pt.jpeg') }}"
                            alt="Default Logo"
                            class="h-32 w-32 object-cover rounded-xl border-2 border-gray-600"
                        >
                        <p class="text-xs text-gray-500 mt-2">Using default logo from assets</p>
                    </div>
                @endif
            </div>

            {{-- SEO Settings --}}
            <div class="pt-8 border-t border-gray-700">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-magnifying-glass class="w-6 h-6 text-white" />
                    </div>
                    <h3 class="text-xl font-bold text-white">SEO Settings</h3>
                </div>

                <div class="space-y-6">
                    {{-- SEO Title --}}
                    <div>
                        <x-atoms.input
                            type="text"
                            wire:model="seoTitle"
                            label="SEO Title"
                            placeholder="e.g., Premium Ornamental Fish Exporter | PT. Tropis Fish Indonesia"
                            :error="$errors->first('seoTitle')"
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">
                                    This appears in search engine results. Leave empty to use website name.
                                </p>
                            </x-slot:help>
                        </x-atoms.input>
                    </div>

                    {{-- SEO Description --}}
                    <div>
                        <x-atoms.textarea
                            wire:model="seoDescription"
                            label="SEO Description"
                            placeholder="Brief description of your business for search engines..."
                            rows="3"
                            :error="$errors->first('seoDescription')"
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">
                                    Appears in search results. Recommended length: 150-160 characters.
                                </p>
                            </x-slot:help>
                        </x-atoms.textarea>
                    </div>

                    {{-- SEO Keywords --}}
                    <div>
                        <x-atoms.textarea
                            wire:model="seoKeywords"
                            label="SEO Keywords"
                            placeholder="ornamental fish, tropical fish, fish export, aquarium fish, Indonesia"
                            rows="2"
                            :error="$errors->first('seoKeywords')"
                        >
                            <x-slot:help>
                                <p class="text-xs text-gray-500 mt-1">
                                    Comma-separated keywords related to your business.
                                </p>
                            </x-slot:help>
                        </x-atoms.textarea>
                    </div>

                    {{-- OG Image --}}
                    <div>
                        <div x-data="fileInputData">
                            <x-atoms.file-input
                                wire:model="ogImage"
                                accept="image/*"
                                label="Open Graph Image"
                                :error="$errors->first('ogImage')"
                                id="og-image-input"
                            >
                                <x-slot:help>
                                    <p class="text-xs text-gray-500 mt-1">
                                        This image appears when sharing on social media. Recommended: 1200x630px. Leave empty to use company logo.
                                    </p>
                                </x-slot:help>

                                <x-slot:preview>
                                    @if ($ogImage)
                                        <div class="mt-4">
                                            <p class="text-xs text-gray-400 mb-2">Preview:</p>
                                            <div class="relative group inline-block">
                                                <img src="{{ $ogImage->temporaryUrl() }}" class="h-32 w-auto object-cover rounded-xl border-2 border-purple-500/50 shadow-lg">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                            </div>
                                        </div>
                                    @endif
                                </x-slot:preview>
                            </x-atoms.file-input>
                        </div>

                        @if($this->currentOgImage)
                            <div class="mt-4 p-4 bg-gray-900/50 rounded-xl border border-gray-700">
                                <p class="text-xs text-gray-400 mb-3">Current OG Image:</p>
                                <img
                                    src="{{ asset('storage/' . $this->currentOgImage) }}"
                                    alt="Current OG Image"
                                    class="h-32 w-auto object-cover rounded-xl border-2 border-gray-600"
                                >
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-between pt-6 border-t border-gray-700">
                <p class="text-xs text-gray-500">
                    Changes will be reflected across the entire website
                </p>
                <x-atoms.button type="submit" variant="secondary" icon="check">
                    Save Settings
                </x-atoms.button>
            </div>
        </form>
    </div>

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">
            <div class="flex items-center gap-3 mb-4">
                <x-heroicon-o-information-circle class="w-6 h-6 text-blue-400" />
                <h3 class="text-lg font-semibold text-white">Where is this used?</h3>
            </div>
            <ul class="space-y-2 text-sm text-gray-400">
                <li class="flex items-start gap-2">
                    <x-heroicon-o-check class="w-4 h-4 text-green-400 mt-0.5 flex-shrink-0" />
                    <span>Browser tab title and page titles</span>
                </li>
                <li class="flex items-start gap-2">
                    <x-heroicon-o-check class="w-4 h-4 text-green-400 mt-0.5 flex-shrink-0" />
                    <span>Navigation bar (logo and company name)</span>
                </li>
                <li class="flex items-start gap-2">
                    <x-heroicon-o-check class="w-4 h-4 text-green-400 mt-0.5 flex-shrink-0" />
                    <span>Footer section</span>
                </li>
                <li class="flex items-start gap-2">
                    <x-heroicon-o-check class="w-4 h-4 text-green-400 mt-0.5 flex-shrink-0" />
                    <span>Admin sidebar</span>
                </li>
            </ul>
        </div>

        <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">
            <div class="flex items-center gap-3 mb-4">
                <x-heroicon-o-light-bulb class="w-6 h-6 text-amber-500" />
                <h3 class="text-lg font-semibold text-white">Tips</h3>
            </div>
            <ul class="space-y-2 text-sm text-gray-400">
                <li class="flex items-start gap-2">
                    <span class="text-amber-500 mt-0.5">•</span>
                    <span>Use a square logo for best results</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-amber-500 mt-0.5">•</span>
                    <span>PNG format with transparent background works best</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-amber-500 mt-0.5">•</span>
                    <span>Keep website name short and memorable</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-amber-500 mt-0.5">•</span>
                    <span>Changes take effect immediately after saving</span>
                </li>
            </ul>
        </div>
    </div>
</div>
