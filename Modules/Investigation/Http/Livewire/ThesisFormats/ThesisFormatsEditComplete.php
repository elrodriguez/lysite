<?php

namespace Modules\Investigation\Http\Livewire\ThesisFormats;

use App\Models\Country;
use App\Models\Universities;
use App\Models\UniversitiesSchools;
use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormat;

class ThesisFormatsEditComplete extends Component
{
    public $name;
    public $description;
    public $type_thesis;
    public $normative_thesis;
    public $enum_types;
    public $enum_normatives;
    public $universities=[];
    public $schools=[];
    public $school;
    public $countries;
    public $country;
    public $format;
    public $university_id;
    public $country_id;
    public $school_id;
    public $format_id;


    public function mount($thesis_format_id)
    {
        $this->format_id = $thesis_format_id;
        $this->countries = Country::all();
        $this->enum_types = $this->getTypes();
        $this->enum_normatives = $this->getNormatives();
        $this->format = InveThesisFormat::find($thesis_format_id);
        $this->name=$this->format->name;
        $this->description=$this->format->description;
        $this->type_thesis=$this->format->type_thesis;
        $this->normative_thesis=$this->format->normative_thesis;
        $this->school_id=$this->format->school_id;
        $temp=$this->format->school_id;
        $this->university_id=UniversitiesSchools::find($this->school_id)->university_id;
        $this->country_id=Universities::find($this->university_id)->country;
        $this->getUniversitiesFirstLoad();
        $this->getSchools();
        $this->school_id=$temp;
    }

    public function getTypes()
    {
        return ['histórica', 'descriptiva', 'experimental', 'meta-descriptiva', 'metodológica', 'teorica', 'otra'];
    }

    public function getNormatives()
    {
        return ['APA', 'Vancouver', 'Otros'];
    }

    public function render()
    {
        return view('investigation::livewire.thesis-formats.thesis-formats-edit-complete')->with([
            'countries' => $this->countries
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'name' => 'required|max:255|',
    ];

    public function save()
    {

        $this->validate();
        //$this->course_image = 'storage/'.substr($this->course_image->store('public/uploads/academic/courses'), 7);    // <----------------------Solo para archivos e imagenes-------------------------------------------
        $this->format->update([
            'name' => trim($this->name),
            'description' => trim($this->description),
            'type_thesis' => trim($this->type_thesis),
            'normative_thesis' => trim($this->normative_thesis),
            'school_id' => $this->school_id,
        ]);


        $this->dispatchBrowserEvent('thesis-format-create', ['tit' => 'Enhorabuena', 'msg' => 'Se registró correctamente']);
    }

    public function back()
    {
        redirect()->route('Investigation_thesis_formats_list_complete');
    }

    public function getUniversities(){
        $this->universities = Universities::where('country', $this->country_id)->orderBy('name', 'ASC')->get();
        $this->school_id=null;
        $this->university_id=null;
        $this->getSchools();
    }

    public function getUniversitiesFirstLoad(){
        $this->universities = Universities::where('country', $this->country_id)->orderBy('name', 'ASC')->get();
    }

    public function getSchools()
    {
        $this->schools=UniversitiesSchools::where('university_id', $this->university_id)->orderBy('name', 'ASC')->get();
    }


}
