@php
    $terms = App\Models\Term::getActive();
@endphp

<!-- Terms Modal -->
<div
    x-data="{ open: false }"
    @open-terms-modal.window="open = true"
    @keydown.escape.window="open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
>
    <!-- Background overlay -->
    <div
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity"
        @click="open = false"
    ></div>

    <!-- Modal panel -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-2xl bg-gradient-to-br from-blue-950 to-blue-900 shadow-2xl transition-all w-full max-w-4xl max-h-[90vh] border border-amber-500/20"
            @click.stop
        >
            <!-- Header -->
            <div class="sticky top-0 z-10 bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-5 border-b border-amber-400/30">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white" id="modal-title">Terms & Conditions</h3>
                        <p class="text-amber-100 text-sm mt-1">Please read our terms carefully</p>
                    </div>
                    <button
                        @click="open = false"
                        class="rounded-lg p-2 text-white transition-colors"
                    >
                        <x-heroicon-o-x-mark class="w-6 h-6" />
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="overflow-y-auto max-h-[calc(90vh-140px)] px-6 py-8">
                <div class="space-y-8">
                    @forelse($terms as $term)
                        <div class="space-y-4">
                            <h2 class="text-xl font-bold text-amber-500 flex items-center gap-3">
                                <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                                {{ $term->title }}
                            </h2>
                            <div class="text-gray-200 leading-relaxed pl-5 space-y-3 whitespace-pre-line">
                                {{ $term->content }}
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-400">No terms available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
