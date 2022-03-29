<?php

namespace Modules\Investigation\Http\Livewire\Thesis;

use App\Models\Country;
use App\Models\Universities;
use App\Models\UniversitiesSchools;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormat;
use Illuminate\Support\Str;
use Modules\Investigation\Entities\InveThesisStudent;

class ThesisCreate extends Component
{
    public $countries = [];
    public $country_id = 'PE';
    public $short_name;
    public $university_id;
    public $school_id;
    public $schools = [];
    public $formats = [];
    public $format_id;
    public $state;
    public $thesis_id;
    public $title;

    public function mount(){
        $this->countries = Country::all();
        $this->getUniversities();
    }

    public function render()
    {
        return view('investigation::livewire.thesis.thesis-create');
    }

    public function getUniversities(){
        $this->universities = Universities::where('country',$this->country_id)->get();
    }
    public function getSchools(){
        $this->schools = UniversitiesSchools::where('university_id',$this->university_id)->get();
    }
    public function getFormat(){
        $this->formats = InveThesisFormat::where('school_id',$this->school_id)->get();
    }

    public function save(){

        $this->validate([
            'short_name' => 'required',
            'title' => 'required',
            'university_id' => 'required',
            'school_id' => 'required',
            'format_id' => 'required'
        ]);

        $thesis = InveThesisStudent::create([
            'external_id' => Str::random(10),
            'short_name' => $this->short_name,
            'title' => $this->title,
            'student_id' => Auth::user()->person->student->id,
            'person_id' => Auth::user()->person->id,
            'user_id' => Auth::id(),
            'university_id' => $this->university_id,
            'school_id' => $this->school_id,
            'format_id' => $this->format_id,
            'state' => $this->state ? true : false
        ]);

        $this->thesis_id = $thesis->id;

        $this->dispatchBrowserEvent('inve-thesis-student-create', ['tit' => 'Enhorabuena','msg' => 'Se registró correctamente']);
    }

    public function parts(){
        //$this->emit('updateThesisList');
        redirect()->route('investigation_thesis_parts',$this->thesis_id);
    }
}
