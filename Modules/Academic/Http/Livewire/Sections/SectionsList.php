<?php

namespace Modules\Academic\Http\Livewire\Sections;

use Livewire\Component;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaSection;

class SectionsList extends Component
{
    public $course;
    public $course_id;

    public function mount($course_id){
        $this->course_id = $course_id;
        $this->course = AcaCourse::find($course_id);
    }


    public function render()
    {
        return view('academic::livewire.sections.sections-list',['sections' => $this->getSections()]);
    }

    public function getSections(){
        return AcaSection::where('course_id', $this->course_id)->paginate(10);
    }
}
