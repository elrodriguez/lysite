<?php

namespace App\Http\Livewire\Auth;

use App\Mail\NewUserNotification;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\Person;
use App\Models\Province;
use App\Models\Universities;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LyRegisterForm extends Component
{
    public $country_id = 'PE';
    public $email;
    public $password;
    public $countries;

    public $info = false;
    public $departments = [];
    public $provinces = [];
    public $districts = [];

    public $identity_document_type_id = 1;
    public $number = null;
    public $names = null;
    public $last_name_father = null;
    public $last_name_mother = null;
    public $full_name = null;
    public $address = null;
    public $mobile_phone = null;
    public $sex = null;
    public $birth_date = null;
    public $department_id = null;
    public $province_id = null;
    public $district_id = null;
    public $user_id = null;
    public $university_id;

    public $universities = [];
    public $user;


    public function render()
    {
        $this->countries = Country::all();

        return view('livewire.auth.ly-register-form');
    }

    public function save()
    {

        $userFind = User::where('email', $this->email)->first();

        if ($userFind) {
            if ($userFind->email_verified_at) {
                return redirect()->route('login');
            } else {
                if (Person::where('user_id', $userFind->id)->first()) {
                    return redirect()->route('login');
                    $this->info = false;
                } else {
                    $this->departments = Department::where('country_id', $this->country_id)->get();
                    $this->universities = Universities::where('country', $this->country_id)->get();
                    $this->info = true;
                }
            }

            $this->user_id = $userFind->id;
            $this->user = $userFind;
        } else {
            $this->validate([
                'password' => 'required|min:8',
                'email' => 'required|email|unique:users,email',
                'country_id' => 'required'
            ]);

            $array = explode("@", $this->email);

            $this->user = User::create([
                'name' => $array[0],
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'country_id' => $this->country_id,
            ]);

            $this->user_id = $this->user->id;
            $this->user->assignRole('Student');
            $this->info = true;
        }
    }

    public function getProvences()
    {
        $this->provinces = Province::where('department_id', $this->department_id)->get();
    }

    public function getDistricts()
    {
        $this->districts = District::where('province_id', $this->province_id)->get();
    }


    public function saveInfo()
    {

        $this->validate([
            'number' => 'required',
            'names' => 'required|max:150',
            'last_name_father' => 'required|max:150',
            'last_name_mother' => 'required|max:150',
            'birth_date' => 'required',
            'university_id' => 'required'
        ]);

        $confirmationCode = Str::random(6);
        $startTime = Carbon::now();
        $endTime = $startTime->copy()->addMinutes(5);

        $this->user->unique_code = $confirmationCode;
        $this->user->start_time_code = $startTime;
        $this->user->end_time_code = $endTime;

        $this->user->save();

        Person::create([
            'identity_document_type_id' => $this->identity_document_type_id,
            'number' => trim($this->number),
            'names' => trim($this->names),
            'last_name_father' => trim($this->last_name_father),
            'last_name_mother' => trim($this->last_name_mother),
            'full_name' => ($this->names . ' ' . $this->last_name_father . ' ' . $this->last_name_mother),
            'address' => trim($this->address),
            'mobile_phone' => trim($this->mobile_phone),
            'sex' => 1,
            'birth_date' => $this->birth_date,
            'email' => trim($this->email),
            'department_id' => $this->department_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'country_id' => $this->country_id,
            'university_id' => $this->university_id,
            'user_id' => $this->user->id
        ]);



        Auth::attempt(array('email' => $this->user->email, 'password' => $this->password));

        //notificación de correo al correo de notificaciones .env MAIL_TO_NOTIFICATIONS si notificaciones new user está activado
        if (env('NOTIFICATIONS_NEW_USER')) {
            $correo = new NewUserNotification($this->user->name, $this->user->email, null, trim($confirmationCode));
            Mail::to(env('MAIL_TO_NOTIFICATIONS'))->send($correo);
        }

        return redirect()->intended('dashboard');
    }
}
