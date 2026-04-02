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

<div class="flex mb-6 flex-col md:flex-row md:items-center justify-between gap-4 p-6 rounded-2xl shadow-sm border border-transparent
    bg-linear-to-r from-sky-100 via-cyan-50 to-blue-100 dark:bg-linear-to-r dark:from-slate-800 dark:via-blue-900 dark:to-slate-900 dark:border-slate-700 transition-all">

    {{-- Info Halaman --}}
    <div class="space-y-1">
        <h1 class="text-xl sm:text-2xl font-black text-indigo-900 dark:text-sky-200 tracking-tight">
            {{ $title }}
        </h1>
        <p class="text-sm font-medium text-indigo-700 dark:text-slate-300 italic">
            {{ $description }}
        </p>
    </div>

    {{-- Kelompok Tombol Aksi --}}
    @if ($addbutton)
        <div class="flex flex-col xs:flex-row items-center gap-3">
            @if ($showImport)
                <button 
                    @click="{{ $idImport }} = true" 
                    type="button"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 w-full xs:w-auto 
                    bg-white/90 dark:bg-slate-700/30 text-emerald-700 dark:text-emerald-200 font-bold text-sm rounded-xl 
                    border border-emerald-200 dark:border-emerald-500 hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-all active:scale-95"
                >
                    <i class="fa-solid fa-file-excel text-base"></i>
                    <span>Import Excel</span>
                </button>
            @endif

            <button 
                @click="{{ $idModal }} = true" 
                type="button"
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 w-full xs:w-auto 
                    bg-linear-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white 
                    font-black text-sm rounded-xl shadow-lg shadow-blue-200 dark:shadow-none transition-all transform active:scale-95 group"
                >
                <i class="fa-solid fa-{{ $buttonIcon }} transition-transform group-hover:rotate-90"></i>
                <span>{{ $buttonLabel }}</span>
            </button>

            @if ($showEksport)
                <button 
                    @click="{{ $idEksport }} = true"  
                    type="button"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 w-full xs:w-auto 
                    bg-white/90 dark:bg-slate-700/30 text-emerald-700 dark:text-emerald-200 font-bold text-sm rounded-xl 
                    border border-emerald-200 dark:border-emerald-500 hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-all active:scale-95"
                >
                    <i class="fa-solid fa-download text-base"></i>
                    <span>Export Excel</span>
                </button>
            @endif
        </div>
    @endif
</div>