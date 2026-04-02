<x-modal-kosong
    idModal='modalEksport'
    icon='download'
    labelModal='Download Data Karyawan'
    ukuran='max-w-4xl'
>

<div class="p-4 md:p-6 space-y-6">
    <button 
        wire:click="exportExcel"
        wire:loading.attr="disabled"
        class="w-full bg-green-600 hover:bg-green-700 disabled:bg-gray-400 text-white font-bold py-2 px-4 rounded transition duration-200"
    >
        <span wire:loading.remove>
            <i class="fas fa-download mr-2"></i> Download Excel
        </span>
        <span wire:loading>
            <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
        </span>
    </button>
</div>

</x-modal-kosong>