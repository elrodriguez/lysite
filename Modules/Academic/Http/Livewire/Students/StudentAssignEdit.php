<?php

namespace Modules\Academic\Http\Livewire\Students;

use Livewire\Component;
use Modules\Academic\Entities\AcaStudent;
use Modules\Academic\Entities\AcaCourse;
use Illuminate\Support\Facades\DB;

class StudentAssignEdit extends Component
{

    public $course_id;
    public $student;
    public $status;
    public $registered_until;
    public $name;


    public function mount($course_id, $id)
    {
        $this->course_id = $course_id;
        $this->student = AcaStudent::find($id);
        $this->name = DB::table('people')->where('id', $this->student->person_id)->value('full_name');
        $this->student->course_name = DB::table('aca_courses')->where('id', $this->student->course_id)->value('name');
    }


    public function render()
    {
        return view('academic::livewire.students.student-assign-edit');
    }
}
