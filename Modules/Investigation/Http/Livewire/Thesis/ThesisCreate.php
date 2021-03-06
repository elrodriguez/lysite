<?php

namespace Modules\Investigation\Http\Livewire\Thesis;

use App\Models\Country;
use App\Models\Person;
use App\Models\Universities;
use App\Models\UniversitiesSchools;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormat;
use Illuminate\Support\Str;
use Modules\Academic\Http\Livewire\Students\Students;
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

    public function mount()
    {
        $person = Person::where('user_id', Auth::id())->first();
        if ($person) {
            $this->country_id = $person->country_id;
            $this->university_id = $person->university_id;

            if ($this->university_id) {
                $this->getSchools();
            }
        }
        $this->countries = Country::all();
        $this->getUniversities();
    }

    public function render()
    {
        return view('investigation::livewire.thesis.thesis-create');
    }

    public function getUniversities()
    {
        $this->universities = Universities::where('country', $this->country_id)->get();
    }
    public function getSchools()
    {
        $this->schools = UniversitiesSchools::where('university_id', $this->university_id)->get();
    }
    public function getFormat()
    {
        $this->formats = InveThesisFormat::where('school_id', $this->school_id)->get();
    }

    public function save()
    {

        $this->validate([
            'short_name' => 'required',
            'title' => 'required',
            'university_id' => 'required',
            'school_id' => 'required',
            'format_id' => 'required'
        ]);

        $thesis_created = InveThesisStudent::where('person_id', Auth::user()->person->id)->where('deleted_at', NULL)->count();
        $allowed_thesis = Person::where('id', Auth::user()->person->id)->first()->allowed_thesis;

        //Condici??n que revisa si cuenta con permisos para crear una nueva tesis

        if ($thesis_created < $allowed_thesis) {
            $thesis = InveThesisStudent::create([
                'external_id' => Str::random(10),
                'short_name' => $this->short_name,
                'title' => $this->title,
                'person_id' => Auth::user()->person->id,
                'user_id' => Auth::id(),
                'university_id' => $this->university_id,
                'school_id' => $this->school_id,
                'format_id' => $this->format_id,
                'state' => $this->state ? true : false
            ]);

            $this->short_name = null;
            $this->title = null;
            $this->country_id = 'PE';
            $this->university_id = null;
            $this->school_id = null;
            $this->format_id = null;
            $this->state = null;
            $this->thesis_id = $thesis->id;

            $this->dispatchBrowserEvent('inve-thesis-student-create', ['tit' => 'Enhorabuena', 'msg' => 'Se registr?? correctamente']);
        } else {
            $this->dispatchBrowserEvent('inve-thesis-student-error', ['tit' => 'No tienes permisos', 'msg' => 'No cuentas con permisos para crear una o m??s tesis, si deseas crear otra t??sis comun??cate con tu coordinador, instructor o administrador del sistema']);
        }
    }

    public function parts()
    {
        //$this->emit('updateThesisList');
        redirect()->route('investigation_thesis_parts', $this->thesis_id);
    }
}
