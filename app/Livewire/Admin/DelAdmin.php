<?php

namespace App\Livewire\Admin;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Traits\WithAlert;

class DelAdmin extends Component
{
    use WithAlert;

    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

    // Properti untuk menampung ID data
    public ?int $dataId = null;

    //variabel bindding
    public $hapus_nama,$hapus_email;

    #[On('load_data_hapus')]
    public function loadData($id)
    {
        $data = User::findOrFail($id);
        $data->with('karyawan');

        if ($data)
        {
            $this->dataId = $data->id;
            $this->hapus_nama = $data->karyawan->nama;
            $this->hapus_email = $data->email;
        
            // Kirim event ke Alpine.js untuk MEMBUKA modal
            $this->dispatch('tampil-hapus-modal');
        }
    }

    public function hapusData()
    {
        //validasi gerbang
        if (Gate::denies('kelola-database-utama')) {
            $this->alert('error', 'Anda tidak memiliki kewenangan');
            return;
        }

        //cegah menghapus diri sendiri
        if (Auth::id() == $this->dataId)
        {
            $this->alert('error', 'Anda tidak bisa menghapus akun anda sendiri');
            return;
        }
        
        $data = User::findOrFail($this->dataId)->delete();
        
        //Kirim event
        $this->alert('success', 'Data Admin berhasil dihapus');
        $this->dispatch('refresh-table');
        $this->dispatch('close-hapus-modal');

        $this->resetError();
        
    }

    public function render()
    {
        return view('livewire.admin.del-admin');
    }
}
