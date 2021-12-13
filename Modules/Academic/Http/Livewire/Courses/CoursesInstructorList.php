<?php

namespace Modules\Academic\Http\Livewire\Courses;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Academic\Entities\AcaSection;

class CoursesInstructorList extends Component
{
    public $courses;

    public function mount(){
        $this->courses = AcaSection::join('aca_courses','aca_sections.course_id','aca_courses.id')
                            ->select(
                                'aca_courses.id AS course_id',
                                'aca_courses.name AS course_name',
                                'aca_courses.description AS course_description',
                                'aca_sections.title AS section_title',
                                DB::raw('(SELECT COUNT(aca_contents.id) FROM aca_contents WHERE section_id = aca_sections.id) AS content_quantity'),
                                DB::raw('(SELECT COUNT(aca_students.person_id) FROM aca_students WHERE course_id = aca_courses.id) AS students_quantity')
                            )
                            ->get();
    }

    public function render()
    {
        return view('academic::livewire.courses.courses-instructor-list');
    }
}
