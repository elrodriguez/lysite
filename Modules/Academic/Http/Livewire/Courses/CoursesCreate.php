<?php

namespace Modules\Academic\Http\Livewire\Courses;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Academic\Entities\AcaCourse;
use Livewire\WithFileUploads;

class CoursesCreate extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $status = true;
    public $course_image;

    public function render()
    {
        return view('academic::livewire.courses.courses-create');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'name' => 'required|max:255|unique:aca_courses,name'
    ];

    public function save(){

        $this->validate();
        $this->course_image = 'storage/'.substr($this->course_image->store('public/uploads/academic/courses'), 7);    // <----------------------Solo para archivos e imagenes-------------------------------------------
        AcaCourse::create([
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status ? true : false,
            'course_image' => $this->course_image,
            'created_by' => Auth::id()
        ]);

        $this->name = null;
        $this->description = null;
        $this->status = true;
        $this->course_image = null;

        $this->dispatchBrowserEvent('aca-courses-create', ['tit' => 'Enhorabuena','msg' => 'Se registró correctamente']);
    }

}
