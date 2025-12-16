@props([
    'label' => null,
    'error' => null,
    'preview' => null,
])

<div class="w-full">
    @if($label)
        <label class="block text-sm font-semibold text-amber-400 mb-3">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <input
            type="file"
            {{ $attributes->merge(['class' => 'hidden']) }}
            id="{{ $attributes->get('id', 'file-input-' . uniqid()) }}"
            x-ref="fileInput"
        >

        <label
            for="{{ $attributes->get('id', 'file-input-' . uniqid()) }}"
            class="inline-flex items-center gap-2 px-6 py-3 border border-amber-500/50 text-amber-400 bg-transparent hover:bg-amber-500/10 rounded-lg transition cursor-pointer font-semibold"
        >
            <x-heroicon-o-arrow-up-tray class="w-5 h-5" />
            <span>Choose File</span>
        </label>

        <span class="ml-3 text-sm text-amber-400/60" x-text="fileName || 'No file chosen'"></span>
    </div>

    @if($error)
        <p class="mt-2 text-sm text-red-400 flex items-center gap-1">
            <x-heroicon-o-exclamation-circle class="w-4 h-4" />
            {{ $error }}
        </p>
    @endif

    @if($preview)
        <div class="mt-4">
            {{ $preview }}
        </div>
    @endif
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('fileInputData', () => ({
        fileName: '',
        init() {
            if (this.$refs.fileInput) {
                this.$refs.fileInput.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    this.fileName = file ? file.name : '';
                });
            }
        }
    }));
});
</script>
