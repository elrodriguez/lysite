<?php

namespace Modules\Academic\Http\Livewire\Courses;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaInstructor;

class CoursesInstructorEdit extends Component
{
    public $course;
    public $instructors;
    public $assigned_instructors;

    public function mount($course_id){
        /*
         $this->courses = AcaCourse::join('aca_courses','aca_sections.course_id','aca_courses.id')->
                             select(
                                 'aca_courses.id AS course_id',
                                 'aca_courses.name AS course_name',
                                 'aca_courses.description AS course_description',
                                 'aca_sections.title AS section_title',
                                 DB::raw('(SELECT COUNT(aca_contents.id) FROM aca_contents WHERE section_id = aca_sections.id) AS content_quantity'),
                                 DB::raw('(SELECT COUNT(aca_students.person_id) FROM aca_students WHERE course_id = aca_courses.id) AS students_quantity')
                             )
                             ->get(); */
                             $this->course = AcaCourse::where('id', '=', $course_id)->
                             select(
                                 'aca_courses.id AS course_id',
                                 'aca_courses.name AS course_name',
                                 'aca_courses.description AS course_description',
                                 'aca_courses.course_image AS course_image',
                                 DB::raw('(SELECT COUNT(aca_instructors.person_id) FROM aca_instructors WHERE aca_instructors.course_id = aca_courses.id) AS instructors_quantity')
                             )
                             ->get();
     }

    public function render()
    {
        return view('academic::livewire.courses.courses-instructor-edit');
    }
}
