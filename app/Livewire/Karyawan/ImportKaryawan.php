<?php

namespace App\Livewire\Karyawan;

use App\Imports\KaryawanImport;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use App\Livewire\Traits\WithAlert;

class ImportKaryawan extends Component
{
    use WithAlert;
    use WithFileUploads;

    public $fileExcel = "templateKaryawan.xlsx";

    #[Rule('required|file|mimes:xlsx,xls,csv')]
    public $file;

    public $failures = [];

    public function import()
    {
       $this->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $import = new KaryawanImport;
        Excel::import($import, $this->file->store('imports'));

        // Ambil failures dari Import class
        $this->failures = collect($import->failures())->map(function ($failure) {
            return [
                'row' => $failure->row(), // nomor baris
                'attribute' => $failure->attribute(), // nama kolom
                'errors' => $failure->errors(), // pesan error array
                'values' => $failure->values(), // data row
            ];
        })->toArray();

        // Jika ada error → jangan tampilkan pesan success
        if (count($this->failures) > 0) {
            return;
        }

        $this->alert('success', 'Data karyawan berhasil disimpan');
        $this->dispatch('close-modal-import');
        $this->dispatch('refresh-table');
    }

    public function resetImport()
    {
        $this->reset('file', 'failures');
        $this->resetValidation(); // hapus pesan error validasi
    }

    public function render()
    {
        return view('livewire.karyawan.import-karyawan');
    }
}