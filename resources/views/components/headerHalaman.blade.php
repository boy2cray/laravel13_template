@props([
    'title' => 'Judul Halaman',
    'description' => 'Keterangan singkat halaman',
    'addbutton' => true,
    'buttonLabel' => 'Tambah Data',
    'buttonIcon' => 'plus',
    'idModal' => 'modalTambah',
    'showImport' => false,
    'showEksport' => false,
    'idImport' => 'modalImport',
    'idEksport' => 'modalEksport'
])

<div class="group relative flex flex-col md:flex-row md:items-center justify-between gap-5 p-6 md:p-8 mb-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-md border border-slate-100 dark:border-slate-700 transition-all duration-300 overflow-hidden z-0">
    
    {{-- Latar Belakang Dekoratif (Subtle Glow) --}}
    <div class="absolute top-0 right-0 w-64 h-64 bg-linear-to-br from-blue-100 to-transparent dark:from-slate-700/50 rounded-full blur-3xl opacity-50 -z-10 translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>

    {{-- Info Halaman --}}
    <div class="flex items-center gap-4 z-10">
        {{-- Garis Aksen Kiri --}}
        <div class="w-1.5 h-12 bg-blue-600 dark:bg-blue-500 rounded-full hidden sm:block"></div>
        
        <div class="space-y-1.5">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 dark:text-white tracking-tight">
                {{ $title }}
            </h1>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                {{ $description }}
            </p>
        </div>
    </div>

    {{-- Kelompok Tombol Aksi --}}
    <div class="flex flex-wrap items-center gap-3 z-10 w-full md:w-auto">
        
        @if ($showImport)
            <button 
                @click="{{ $idImport }} = true" 
                type="button"
                class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 font-semibold text-sm rounded-xl border border-emerald-200 dark:border-emerald-800/50 hover:bg-emerald-500 hover:text-white dark:hover:bg-emerald-600 transition-all duration-200 active:scale-95"
            >
                <i class="fa-solid fa-file-excel"></i>
                <span>Import Excel</span>
            </button>
        @endif
        
        @if ($showEksport)
            <button 
                @click="{{ $idEksport }} = true"  
                type="button"
                class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 font-semibold text-sm rounded-xl border border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all duration-200 active:scale-95"
            >
                <i class="fa-solid fa-download"></i>
                <span>Export Excel</span>
            </button>
        @endif

        @if ($addbutton)
            <button 
                @click="{{ $idModal }} = true" 
                type="button"
                class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-xs hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-200 active:scale-95 group"
                >
                <i class="fa-solid fa-{{ $buttonIcon }} transition-transform duration-300 group-hover:rotate-90"></i>
                <span>{{ $buttonLabel }}</span>
            </button>
        @endif

    </div>
</div>