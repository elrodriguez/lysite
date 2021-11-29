<?php

namespace Modules\Academic\Http\Livewire\Courses;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Academic\Entities\AcaCourse;

class CoursesCreate extends Component
{
    public $name;
    public $description;
    public $status = true;

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

        AcaCourse::create([
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status ? true : false,
            'created_by' => Auth::id()
        ]);

        $this->name = null;
        $this->description = null;
        $this->status = true;

        $this->dispatchBrowserEvent('aca-courses-create', ['tit' => 'Enhorabuena','msg' => 'Se registró correctamente']);
    }

}
