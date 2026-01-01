@php
    $companyLogo = App\Models\Setting::get('company_logo');
    $companyName = App\Models\Setting::get('company_name', 'PT. Tropis Fish Indonesia');
    $companyDesc = App\Models\Setting::get('company_description', 'Export of Ornamental Freshwater Fish');
    $companySection = App\Models\FooterSection::getByType('company');
    $menuSection = App\Models\FooterSection::getByType('menu');
    $informationSection = App\Models\FooterSection::getByType('information');
    $socialSection = App\Models\FooterSection::getByType('social');
@endphp

<footer
    class="bg-amber-500 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden"
    x-data="{ visible: false }"
    x-intersect:enter="visible = true"
>
   
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            {{-- Company Info --}}
            <div
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-700 ease-out"
            >
                <div class="flex items-center gap-3 mb-4 transform transition-transform duration-300">
                    <img
                        src="{{ $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg') }}"
                        alt="{{ $companyName }} Logo"
                        class="w-16 h-16 rounded-full object-cover shadow-lg "
                    >
                    <div class="flex flex-col gap-0.5">
                <span id="nav-brand" class="font-stencil font-bold text-xl text-white leading-tight">
                    {{ $companyName }}
                </span>

                <div class="relative w-full flex justify-center">
                    <span
                        class="block h-[2px] w-52 bg-gradient-to-r from-transparent via-white to-transparent opacity-80"></span>
                </div>

                <span class="text-sm text-white font-medium">
                    {{ $companyDesc }}
                </span>
            </div>
                </div>
                <p class="text-white/90 leading-relaxed">
                    {{ $companySection?->description ?? 'Premium quality tropical ornamental fish supplier for your aquarium' }}
                </p>
            </div>

            {{-- Menu Section --}}
            @if($menuSection)
                <div
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    class="transition-all duration-700 ease-out delay-100"
                >
                    <h4 class="font-bold text-white mb-4 text-lg">{{ $menuSection->title }}</h4>
                    <div class="flex flex-col gap-2">
                        @foreach($menuSection->links as $index => $link)
                            @if($link['text'] === 'Terms' || str_contains($link['url'], 'terms'))
                                <a
                                    href="#"
                                    @click.prevent="$dispatch('open-terms-modal')"
                                    class="text-white/80 hover:text-white transition-all duration-300 inline-block"
                                >
                                    {{ $link['text'] }}
                                </a>
                            @elseif(str_contains($link['url'], '#company-profile'))
                                <a
                                    href="{{ $link['url'] }}"
                                    class="company-profile-link text-white/80 hover:text-white transition-all duration-300 inline-block"
                                >
                                    {{ $link['text'] }}
                                </a>
                            @elseif(str_contains($link['url'], '#stock-list'))
                                <a
                                    href="{{ $link['url'] }}"
                                    class="stock-list-link text-white/80 hover:text-white transition-all duration-300 inline-block"
                                >
                                    {{ $link['text'] }}
                                </a>
                            @elseif(str_contains($link['url'], '#gallery'))
                                <a
                                    href="{{ $link['url'] }}"
                                    class="gallery-link text-white/80 hover:text-white transition-all duration-300 inline-block"
                                >
                                    {{ $link['text'] }}
                                </a>
                            @else
                                <a
                                    href="{{ $link['url'] }}"
                                    class="text-white/80 hover:text-white transition-all duration-300 inline-block"
                                >
                                    {{ $link['text'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Information Section --}}
            @if($informationSection)
                <div
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    class="transition-all duration-700 ease-out delay-200"
                >
                    <h4 class="font-bold text-white mb-4 text-lg">{{ $informationSection->title }}</h4>
                    <div class="flex flex-col gap-2">
                        @foreach($informationSection->links as $link)
                            @if($link['text'] === 'Terms & Conditions' || str_contains($link['url'], 'terms'))
                                <a
                                    href="#"
                                    @click.prevent="$dispatch('open-terms-modal')"
                                    class="text-white/80 hover:text-white transition-all duration-300 inline-block"
                                >
                                    {{ $link['text'] }}
                                </a>
                            @else
                                <a
                                    href="{{ $link['url'] }}"
                                    class="text-white/80 hover:text-white transition-all duration-300 inline-block"
                                >
                                    {{ $link['text'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Social Media Section --}}
            @if($socialSection)
                <div
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    class="transition-all duration-700 ease-out delay-300"
                >
                    <h4 class="font-bold text-white mb-4 text-lg">{{ $socialSection->title }}</h4>
                    <div class="flex gap-4">
                        @foreach($socialSection->links as $index => $link)
                            <a
                                href="{{ $link['url'] }}"
                                class="w-10 h-10 bg-white/20 backdrop-blur-sm hover:text-amber-600 text-white rounded-lg flex items-center justify-center transition-all duration-300 stagger-{{ $index + 1 }}"
                                title="{{ $link['text'] }}"
                            >
                                @if($link['icon'] === 'facebook')
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                @elseif($link['icon'] === 'twitter')
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                @elseif($link['icon'] === 'instagram')
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                @elseif($link['icon'] === 'linkedin')
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                @elseif($link['icon'] === 'youtube')
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                @else
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="border-t border-white/20 pt-8 text-center text-white transition-all duration-700 ease-out delay-400"
        >
            <p class="hover:scale-105 transition-transform duration-300 inline-block">
                &copy; {{ date('Y') }} {{ $companyName }}. {{ $companySection?->copyright_text ?? 'All rights reserved' }}.
            </p>
        </div>
    </div>
</footer>
