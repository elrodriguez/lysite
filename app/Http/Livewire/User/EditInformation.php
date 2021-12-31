<?php

namespace App\Http\Livewire\User;

use App\Models\Department;
use App\Models\District;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditInformation extends Component
{

    public $identity_document_type_id = null;
    public $number = null;
    public $names = null;
    public $last_name_father = null;
    public $last_name_mother = null;
    public $full_name = null;
    public $address = null;
    public $mobile_phone = null;
    public $sex = null;
    public $birth_date = null;
    public $email = null;
    public $department_id = null;
    public $province_id = null;
    public $district_id = null;
    public $user_id = null;

    public $identity_document_types;
    public $departments = [];
    public $provinces = [];
    public $districts = [];
    public $person;

    public function mount(){
        $this->person = Person::where('user_id',Auth::id())->first();

        $this->email = Auth::user()->email;

        if($this->person){
            $this->identity_document_type_id = $this->person->identity_document_type_id;
            $this->number = $this->person->number;
            $this->names = $this->person->names;
            $this->last_name_father = $this->person->last_name_father;
            $this->last_name_mother = $this->person->last_name_mother;
            $this->full_name = $this->person->full_name;
            $this->address = $this->person->address;
            $this->mobile_phone = $this->person->mobile_phone;
            $this->sex = $this->person->sex;
            $this->birth_date = $this->person->birth_date;
            $this->email = $this->person->email;
            $this->department_id = $this->person->department_id;
            $this->province_id = $this->person->province_id;
            $this->district_id = $this->person->district_id;
            $this->user_id = $this->person->user_id;
        }

        $this->identity_document_types = IdentityDocumentType::where('status',true)->get();

        $this->departments = Department::where('active',true)->get();

        if($this->department_id){
            $this->provinces = Province::where('department_id',$this->department_id)->get();
        }

        if($this->province_id){
            $this->districts = District::where('province_id',$this->province_id)->get();
        }
    }

    public function render()
    {
        return view('livewire.user.edit-information');
    }

    public function getProvinces(){
        $this->provinces = Province::where('department_id',$this->department_id)->get();
    }

    public function getDistricts(){
        $this->districts = District::where('province_id',$this->province_id)->get();
    }

    public function save(){

        $this->validate([
            'identity_document_type_id' => 'required',
            'number' => 'required',
            'names' => 'required|max:150',
            'last_name_father'=> 'required|max:150',
            'last_name_mother' => 'required|max:150',
            'address' => 'required',
            'sex' => 'required',
            'birth_date' =>'required',
            'email' => 'required',
            'department_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required'
        ]);

        if($this->person){
            $this->person->update([
                'identity_document_type_id' => $this->identity_document_type_id,
                'number' => trim($this->number),
                'names' => trim($this->names),
                'last_name_father' => trim($this->last_name_father),
                'last_name_mother' => trim($this->last_name_mother),
                'full_name' => ($this->names.' '.$this->last_name_father.' '.$this->last_name_mother),
                'address' => trim($this->address),
                'mobile_phone' => trim($this->mobile_phone),
                'sex' => $this->sex,
                'birth_date' => $this->birth_date,
                'email' => trim($this->email),
                'department_id' => $this->department_id,
                'province_id' => $this->province_id,
                'district_id' => $this->district_id
            ]);
        }else{
            Person::create([
                'identity_document_type_id' => $this->identity_document_type_id,
                'number' => trim($this->number),
                'names' => trim($this->names),
                'last_name_father' => trim($this->last_name_father),
                'last_name_mother' => trim($this->last_name_mother),
                'full_name' => ($this->names.' '.$this->last_name_father.' '.$this->last_name_mother),
                'address' => trim($this->address),
                'mobile_phone' => trim($this->mobile_phone),
                'sex' => $this->sex,
                'birth_date' => $this->birth_date,
                'email' => trim($this->email),
                'department_id' => $this->department_id,
                'province_id' => $this->province_id,
                'district_id' => $this->district_id,
                'user_id' => Auth::id()
            ]);
        }

        $this->dispatchBrowserEvent('set-person-update', ['tit' => 'Enhorabuena','msg' => 'Se actualizó correctamente']);

        $this->exit();

    }
    public function exit(){
        redirect()->route('dashboard');
    }
}
