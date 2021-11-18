<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;  //para Recaptcha
class RegisterForm extends Component
{
    public $full_name;
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.auth.register-form');
    }

    public function save(){
        
        $user = $this->validate([

            'password' => 'required|min:8',

            'email' => 'required|email',
            
        ]);

        $user = User::create([
            'name' => $this->full_name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);


        $user->assignRole('Student');

        Auth::attempt(array('email' => $user->email, 'password' => $this->password));

        return redirect()->intended('dashboard');

    }

    
}
