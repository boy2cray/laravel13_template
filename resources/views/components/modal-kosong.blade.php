<div 
    x-show="{{ $idModal }}"
    x-transition.opacity.duration.300ms
    x-effect="document.body.classList.toggle('overflow-hidden', {{ $idModal }})"
    class="fixed inset-0 bg-gray-950/60 backdrop-blur-sm flex items-center justify-center z-100 p-4"
    x-cloak
>
    <div 
        x-show="{{ $idModal }}"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="relative {{ $ukuran }} bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-2xl w-full flex flex-col max-h-[90vh] border border-gray-100 dark:border-gray-800"
    >
        {{-- ================= HEADER MODAL ================= --}}
        <div class="flex items-center justify-between p-5 border-b border-gray-100 dark:border-gray-800 bg-gray-100 dark:bg-gray-800/20 rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/40 rounded-lg">
                    <x-icon
                        name="{{ $icon }}"
                        class="h-6 w-6 text-blue-600 dark:text-blue-400"
                    />
                </div>
                <h3 class="text-lg font-black text-gray-900 dark:text-white tracking-tight">
                    {{ $labelModal }}
                </h3>
            </div>

            {{-- Tombol Tutup (X) --}}
            <button 
                type="button" 
                @click="{{ $idModal }} = false" 
                wire:loading.attr="disabled"
                class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 rounded-full p-2 transition-all"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- ================= KONTEN ================= --}}
        <div class="p-1 overflow-y-auto grow dark:text-gray-300">
            {{ $slot}}
        </div>

    </div>
</div>