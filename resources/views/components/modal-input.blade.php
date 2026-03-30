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

        {{-- ================= KONTEN MODAL ================= --}}
        <div class="p-6 md:p-8 overflow-y-auto grow text-gray-700 dark:text-gray-300 custom-scrollbar">
            {{ $slot }}
        </div>

        {{-- ================= FOOTER MODAL ================= --}}
        <div class="flex items-center justify-end gap-3 p-5 border-t border-gray-100 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-800/10 rounded-b-2xl">
            {{-- Tombol Batal --}}
            <button 
                @click="{{ $idModal }} = false" 
                type="button"
                wire:loading.attr="disabled"
                wire:click="{{ $closeEvent ?? 'resetError' }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all active:scale-95 disabled:opacity-50"
            >
                <i class="fa-solid fa-arrow-rotate-left text-xs"></i>
                Batal
            </button>

            {{-- Tombol Simpan / Proses --}}
            <button 
                type="button" 
                wire:click="{{ $clickEvent }}"
                wire:loading.attr="disabled"
                wire:target="{{ $clickEvent }}"
                class="inline-flex items-center justify-center gap-2 px-8 py-2.5 bg-blue-600 text-white text-sm font-black rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 dark:shadow-none transition-all transform active:scale-95 disabled:opacity-70"
            >
                {{-- Status Loading --}}
                <span wire:loading wire:target="{{ $clickEvent }}" class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-notch animate-spin"></i>
                    Memproses...
                </span>

                {{-- Status Normal --}}
                <span wire:loading.remove wire:target="{{ $clickEvent }}" class="flex items-center gap-2">
                    <i class="fa-solid fa-check-circle"></i>
                    {{ $buttonLabel ?? 'Simpan Data' }}
                </span>
            </button>
        </div>
    </div>
</div>