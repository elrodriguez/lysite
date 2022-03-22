<?php

namespace Modules\Investigation\Http\Livewire\ThesisFormats;

use Livewire\Component;
use App\Models\universities_schools;
use Modules\Investigation\Entities\InveThesisFormat;

class ThesisFormatsCreate extends Component
{
    public $school_id;
    public $name;
    public $description;
    public $type_thesis;
    public $normative_thesis;
    public $enum_types;
    public $enum_normatives;

    public function mount($school_id)
    {
        $this->school_id = $school_id;

        $this->enum_types = $this->getTypes();
        $this->enum_normatives = $this->getNormatives();
    }

    public function getTypes()
    {
        return ['histórica', 'descriptiva', 'experimental', 'meta-descriptiva', 'metodológica', 'teorica', 'otra'];
    }

    public function getNormatives()
    {
        return ['APA', 'VANCOUVER', 'CALIFORNIA', 'CUSTOM'];
    }

    public function render()
    {
        return view('investigation::livewire.thesis-formats.thesis-formats-create', ['school' => $this->getSchool()]);
    }

    public function getSchool()
    {
        return universities_schools::find($this->school_id);
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
        $newUniversity = InveThesisFormat::create([
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
        redirect()->route('Investigation_thesis_formats_list', $school_id = $this->school_id);
    }
}
