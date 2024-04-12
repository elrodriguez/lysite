<?php

namespace App\Http\Livewire\Auth;

use App\Mail\NewUserNotification;
use App\Models\Country;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LyRegisterForm extends Component
{
    public $country_id = 'PE';
    public $email;
    public $password;
    public $countries;


    public function render()
    {
        $this->countries = Country::all();
        return view('livewire.auth.ly-register-form');
    }

    public function save()
    {

        $user = $this->validate([

            'password' => 'required|min:8',
            'email' => 'required|email|unique:users,email',
            'country_id' => 'required'

        ]);

        $array = explode("@", $this->email);

        $user = User::create([
            'name' => $array[0],
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'country_id' => $this->country_id,
        ]);


        $user->assignRole('Student');

        Auth::attempt(array('email' => $user->email, 'password' => $this->password));

        //notificación de correo al correo de notificaciones .env MAIL_TO_NOTIFICATIONS si notificaciones new user está activado
        if (env('NOTIFICATIONS_NEW_USER')) {
            $correo = new NewUserNotification($user->name, $user->email, trim('12345678'));
            Mail::to(env('MAIL_TO_NOTIFICATIONS'))->send($correo);
        }

        return redirect()->intended('dashboard');
    }
}
