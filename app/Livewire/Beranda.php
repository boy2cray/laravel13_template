<?php

namespace App\Livewire;

use Livewire\Component;

class Beranda extends Component
{
    public $judul = 'Ini komponen livewire beranda';

    public function render()
    {
        return view('livewire.beranda');
    }
}
