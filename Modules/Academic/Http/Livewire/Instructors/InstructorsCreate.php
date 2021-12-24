<?php

namespace Modules\Academic\Http\Livewire\Instructors;

use Livewire\Component;
use Modules\Academic\Entities\AcaCourse;
use Illuminate\Support\Facades\DB;

class InstructorsCreate extends Component
{
    public $course_id;
    public $course;
    public $search='';

    public function mount($course_id){
        $this->course_id = $course_id;
        $this->course = AcaCourse::find($course_id);

    }
    public function render()
    {
        return view('academic::livewire.instructors.instructors-create',['instructors' => $this->getSections()]);
    }

    public function getSections(){
        $instructors = DB::table('aca_instructors')
            ->join('aca_courses', 'aca_instructors.course_id', '!=', 'aca_courses.id')
            ->join('people', 'aca_instructors.person_id', '=', 'people.id')
            ->select('people.full_name as full_name', 'aca_instructors.person_id as person_id')
            ->where('people.full_name', 'like', '%'.$this->search.'%')
            ->orWhere('people.number', 'like', '%'.$this->search.'%')
            ->get();
            return $instructors;

    }
}
