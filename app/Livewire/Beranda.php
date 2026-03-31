<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Karyawan;
use App\Models\User;

class Beranda extends Component
{
    public $judul = 'Dashboard';
    public $jumlahKaryawan;
    public $jumlahAdmin;

    public function mount()
    {
        $this->jumlahKaryawan = Karyawan::count();
        $this->jumlahAdmin = User::whereIn('otoritas', ['admin', 'su'])->count();
    }

    public function render()
    {
        return view('livewire.beranda');
    }
}
