<?php

namespace App\Livewire\Karyawan;
use Livewire\WithFileUploads;
use App\Models\Karyawan;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Traits\WithAlert;

class AddKaryawan extends Component
{
    use WithAlert;
    use WithFileUploads;

    //variabel bindding
    public $nik, $nama, $jk='', $asal, $tgl_lahir, $alamat, $foto;

    // Reset validasi dan data
    public function resetError()
    {
        $this->resetValidation();
        $this->reset(['nik', 'nama', 'jk', 'asal', 'tgl_lahir', 'alamat', 'foto']);
    }

    public function mount()
    {
        $this->tgl_lahir = now()->format('Y-m-d');
    }

    protected function rules()
    {
        return [
            'nik'       => 'required|min:3|unique:karyawan,nik',
            'nama'      => 'required|string|max:50',
            'jk'        => 'required|in:L,P',
            'asal'      => 'required|string|max:30',
            'tgl_lahir' => 'required|date',
            'alamat'    => 'required|string|max:150',
            'foto'      => 'nullable|image|max:2048',
        ];
    }

    public function tambahData()
    {
        //validasi gerbang
        if (Gate::denies('kelola-database-utama')) {
            $this->error('Anda tidak memiliki kewenangan...');
            return;
        }
        
        $validasi = $this->validate();

        // Logika Upload File
        $file_foto = tambah_file($this->foto, 'foto-karyawan');
        $validasi['foto'] = $file_foto;

        // Simpan ke Database
        Karyawan::create($validasi);

        // Feedback & Reset
        $this->success('Data berhasil disimpan');
        $this->dispatch('close-modal');
        $this->dispatch('refresh-table'); // Untuk refresh table di parent
        
        $this->resetError();
    }

    public function render()
    {
        return view('livewire.karyawan.add-karyawan');
    }
}
