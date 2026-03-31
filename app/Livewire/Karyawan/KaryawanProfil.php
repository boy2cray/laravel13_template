<?php

namespace App\Livewire\Karyawan;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Traits\WithAlert;


class KaryawanProfil extends Component
{
    use WithAlert;
    use WithFileUploads;

    public $karyawan;
    public $newPhoto;

    // Kita menerima ID warga saat komponen dipanggil
    public function mount()
    {
        // Mencari data warga berdasarkan ID
        $id_user = Auth::user()->id_karyawan;
        $this->karyawan = Karyawan::findOrFail($id_user);
    }

    // Fungsi ini dipanggil saat tombol "Simpan Foto" ditekan
    public function updatePhoto()
    {
        // Validasi: Harus gambar & maksimal 2MB
        $this->validate([
            'newPhoto' => 'image|max:2048', 
        ]);

        $path = update_file($this->newPhoto,$this->karyawan->foto,'foto-karyawan');

        // Update database
        $this->karyawan->update(['foto' => $path]);

        // Reset variabel upload & beri notifikasi
        $this->reset('newPhoto');
        $this->alert('success', 'Data karyawan berhasil disimpan');
    }


    public function render()
    {
        return view('livewire.karyawan.karyawan-profil');
    }
}
