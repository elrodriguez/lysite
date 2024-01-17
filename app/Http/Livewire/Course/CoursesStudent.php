<?php

namespace App\Http\Livewire\Course;

use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Academic\Entities\AcaStudent;

class CoursesStudent extends Component
{
    public $courses = [];

    public function mount()
    {
        $person = Person::where('user_id', Auth::id())->first();

        if ($person) {
            $this->courses = AcaStudent::join('aca_courses', 'course_id', 'aca_courses.id')
                ->select(
                    'aca_courses.id',
                    'aca_courses.name',
                    'aca_courses.description',
                    'aca_courses.course_image',
                    'aca_courses.main_video'
                )
                ->where('person_id', $person->id)
                ->where('aca_courses.status', 1)
                ->where('aca_students.registered_until', '>=', Carbon::now()->format('Y-m-d'))
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.course.courses-student');
    }
}
