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
            'g-recaptcha-response' => function ($attribute, $value, $fail) {                   //para Recaptcha
                $secretKey = config('services.recaptcha.secret');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url ="https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response= \file_get_contents($url);
                $response= json_decode($response);
                if(!$response->success){
                    Session::flash('g-recaptcha-response', 'Porfavor marca la recaptcha');
                    Session::flash('alert-class', 'alert-danger');
                    $fail($attribute.' google reCaptcha falló');
                }
            },                //para Recaptcha

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
