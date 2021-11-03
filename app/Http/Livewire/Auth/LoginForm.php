<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{
    public $email;
    public $password;
    public $rememberme;

    public function render()
    {
        return view('livewire.auth.login-form');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if(Auth::attempt(array('email' => $this->email, 'password' => $this->password),$this->rememberme)){

            request()->session()->regenerate();

            return redirect()->intended('dashboard');

        }else{
            $this->resetInput();
            session()->flash('message', 'Las credenciales proporcionadas no coinciden con nuestros registros.');
        }
    }

    public function resetInput(){
        $this->email = null;
        $this->password = null;
        $this->rememberme = null;
    }
}
