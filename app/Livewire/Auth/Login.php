<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required|email')]
    public $email = '';

    #[Rule('required')]
    public $password = '';

   
    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return $this->redirect('/dashboard', navigate: true);
        }

        $this->addError('email', 'Email atau password yang Anda masukkan salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}