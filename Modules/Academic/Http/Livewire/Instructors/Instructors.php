<?php

namespace Modules\Academic\Http\Livewire\Instructors;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Academic\Entities\AcaInstructor;
use Modules\Academic\Entities\AcaCourse;
use Illuminate\Support\Facades\DB;


class Instructors extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $course_id;
    public $course;
    public $results;

    public function mount($course_id){
        $this->course_id = $course_id;
        $this->course = AcaCourse::find($course_id);

    }
    public function render()
    {
        return view('academic::livewire.instructors.instructors',['instructors' => $this->getSections()]);  // ['instructors' => es la variable que va a la vista

    }

public function getSections(){
    /*
//return AcaContent::where('section_id', $this->section_id)->paginate(10);
$contents = AcaInstructor::where('course_id', $this->course_id);
return $contents->paginate(10); */

$instructors = DB::table('aca_instructors')
            ->join('aca_courses', 'aca_instructors.course_id', '=', 'aca_courses.id')
            ->join('people', 'aca_instructors.person_id', '=', 'people.id')
            ->select('aca_courses.id as course_id', 'aca_courses.name as course_name', 'people.full_name as full_name', 'aca_instructors.person_id as person_id')
            ->where('aca_instructors.course_id', $this->course_id)
            ->get();
            return $instructors;
}

public function getData(){
return AcaInstructor::where('content_url','like','%'.$this->search.'%')
                ->paginate(10);
}

public function getSearch($search)
    {
        $results = DB::table('aca_instructors')
            ->join('aca_courses', 'aca_instructors.course_id', '=', 'aca_courses.id')
            ->join('people', 'aca_instructors.person_id', '=', 'people.id')
            ->select('aca_courses.id as course_id', 'aca_courses.name as course_name', 'people.full_name as full_name', 'aca_instructors.person_id as person_id')
            ->where('people.full_name','like','%'.$search.'%')
            ->orWhere('people.document','like','%'.$search.'%')
            ->get();
            return $results;
    }

}
