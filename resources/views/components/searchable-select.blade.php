@props([
    'options' => [],      // Format: [['value' => 'id', 'label' => 'Teks'], ...]
    'placeholder' => 'Pilih opsi...',
])

@php
    // Menyiapkan data untuk Alpine.js
    $alpineData = collect($options)->map(function($item) {
        return [
            'value' => (string) $item['value'], 
            'label' => $item['label'],
            'searchString' => strtolower($item['label'])
        ];
    })->values()->toArray();
@endphp

<div x-data="{ 
        open: false, 
        search: '',
        options: @json($alpineData),
        selectedValue: null, // Dibiarkan null, akan diisi otomatis oleh Livewire/x-modelable
        placeholder: @json($placeholder),
        
        get selectedLabelText() {
            const selectedOpt = this.options.find(item => item.value == this.selectedValue);
            return selectedOpt ? selectedOpt.label : this.placeholder;
        },
        
        get filteredOptions() {
            if (this.search === '') return this.options;
            const searchLower = this.search.toLowerCase();
            return this.options.filter(item => item.searchString.includes(searchLower));
        },

        selectOption(val) {
            this.selectedValue = val;
            this.open = false;
            this.search = ''; // Reset pencarian saat opsi dipilih
        }
    }" 
     {{-- Keajaiban Livewire v4 ada di sini: Menghubungkan state internal dengan wire:model eksternal --}}
     x-modelable="selectedValue"
     
     {{-- Mengizinkan injeksi class dari luar komponen --}}
     {{ $attributes->merge(['class' => 'relative w-full font-sans text-left']) }}
     
     @click.away="open = false"
     @keydown.escape="open = false">
    
    {{-- Input tersembunyi jika Anda sesekali ingin memakai komponen ini di Form HTML murni (tanpa Livewire) --}}
    <input type="hidden" :name="$attributes->get('name') ?? 'selected_value'" x-model="selectedValue">

    <button @click="open = !open; if(open) $nextTick(() => $refs.searchInput.focus())" 
            type="button" 
            class="flex items-center justify-between w-full pl-3 pr-3 py-2.5 text-sm border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg shadow-sm hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <span class="truncate font-medium" x-text="selectedLabelText"></span>
        
        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400 ml-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open" 
         x-transition.opacity.duration.200ms
         style="display: none;" 
         class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl overflow-hidden">
        
        <div class="p-2 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input type="text" x-ref="searchInput" x-model="search" class="block w-full pl-9 pr-3 py-2 text-xs md:text-sm border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="Cari data...">
            </div>
        </div>

        <ul class="max-h-60 overflow-y-auto p-1 text-sm">
            <template x-for="item in filteredOptions" :key="item.value">
                <li @click="selectOption(item.value)"
                    :class="{'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-semibold': item.value == selectedValue, 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700': item.value != selectedValue}"
                    class="cursor-pointer px-3 py-2 rounded-md transition-colors flex items-center justify-between">
                    
                    <span class="truncate" x-text="item.label"></span>
                    
                    <template x-if="item.value == selectedValue">
                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </template>
                </li>
            </template>
            
            <li x-show="filteredOptions.length === 0" style="display: none;" class="px-3 py-4 text-center text-gray-500 dark:text-gray-400 text-xs">
                Data tidak ditemukan.
            </li>
        </ul>
    </div>
</div>