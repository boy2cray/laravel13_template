@props(['tabs', 'active'])

<div x-data="{ activeTab: '{{ $active ?? $tabs[0]['id'] }}' }">
    {{-- TAB HEADER --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-1.5 sticky top-1 z-20 lg:static mb-4">
        {{-- Kita tambahkan pb-1 agar shadow dari tab yang aktif tidak terpotong saat di-scroll di mobile --}}
        <div class="flex overflow-x-auto no-scrollbar gap-1 pb-1" role="tablist">
            @foreach($tabs as $tab)
                <button @click="activeTab = '{{ $tab['id'] }}'" 
                    :class="activeTab === '{{ $tab['id'] }}' 
                        ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200 dark:shadow-none' 
                        : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200'"
                    {{-- PERBAIKAN DI SINI: Tambahkan shrink-0 dan ubah flex-1 menjadi sm:flex-1 --}}
                    class="shrink-0 sm:flex-1 flex items-center justify-center gap-2 whitespace-nowrap py-2.5 px-4 rounded-xl text-sm font-semibold transition-all duration-200 focus:outline-none">
                    
                    @if(isset($tab['icon']))
                        <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $tab['icon'] }}"></path>
                        </svg>
                    @endif
                    
                    <span>{{ $tab['label'] }}</span>
                </button>
            @endforeach
        </div>
    </div>

    {{-- TAB CONTENT WRAPPER --}}
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 min-h-100">
        {{ $slot }}
    </div>
</div>