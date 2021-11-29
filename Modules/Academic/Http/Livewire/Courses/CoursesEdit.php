<?php

namespace Modules\Academic\Http\Livewire\Courses;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Academic\Entities\AcaCourse;

class CoursesEdit extends Component
{
    public $course;
    public $name;
    public $description;
    public $status = true;
    public function mount($course_id){
        $this->course = AcaCourse::find($course_id);
        $this->name = $this->course->name;
        $this->description = $this->course->description;
        $this->status = $this->course->status;
    }

    public function render()
    {
        return view('academic::livewire.courses.courses-edit');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'name' => 'required|max:255'
    ];

    public function update(){
        
        $this->validate([
            'name' => 'unique:aca_courses,name,'.$this->course->id
        ]);

        $this->course->update([
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status ? true : false,
            'updated_by' => Auth::id()
        ]);

        $this->dispatchBrowserEvent('aca-courses-update', ['tit' => 'Enhorabuena','msg' => 'Se Actualizo correctamente']);
    }

}
