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
    public $registered_until = null;

    public function mount(){
        $person = Person::where('user_id',Auth::id())->first();
        if($person){
            $this->person_id = $person->id;
            $this->date_end = null;
            $this->registered_until = AcaStudent::where('person_id',$this->person_id)
                                            ->max('registered_until');
        }

    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-student');
    }
}
