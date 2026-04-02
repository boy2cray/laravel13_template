<?php

namespace App\Livewire\Karyawan;
use App\Exports\KaryawanExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;

class EksportKaryawan extends Component
{
    public function exportExcel()
    {
        return Excel::download(new KaryawanExport, 'daftar-karyawan.xlsx');
    }

    public function render()
    {
        return view('livewire.karyawan.eksport-karyawan');
    }
}
