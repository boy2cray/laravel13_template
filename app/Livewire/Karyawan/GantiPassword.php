<?php

namespace App\Livewire\Karyawan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Livewire\Traits\WithAlert;


class GantiPassword extends Component
{
    use WithAlert;

    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

    Public $id_user;

    public $password_old, $password, $password_confirmation;

    protected $rules = [
        'password_old' => 'required',
        'password' => 'required|min:3|confirmed'
    ];

    public function editPwd()
    {
        $valaidasi = $this->validate();

        $user = Auth::user();

        //Cek password lama
        if (!Hash::check($this->password_old, $user->password)) {
            $this->alert('error', 'Password lama tidak cocok');
            return;
        }

        //Update password
        $user->update([
            'password' => Hash::make($this->password)
        ]);

        $this->alert('success', 'Password berhasil diubah');
        $this->dispatch('close-edit-modal');

        $this->resetError();
       
    }
    
    public function render()
    {
        return view('livewire.karyawan.ganti-password');
    }
}
