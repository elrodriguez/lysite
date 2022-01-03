<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Academic\Entities\AcaStudent;

class DashboardStudent extends Component
{
    public $person_id;
    public $date_end;
    public $courses = [];

    public function mount(){
        $person = Person::where('user_id',Auth::id())->first();
        if($person){
            $this->person_id = $person->id;
            $this->date_end = null;
            $this->courses = AcaStudent::join('aca_courses','course_id','courses.id')
                                ->select(
                                    'aca_courses.name',
                                    'aca_courses.description'
                                );
        }
        
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-student');
    }
}
