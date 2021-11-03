<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
