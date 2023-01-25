<?php

namespace Modules\Chat\Http\Livewire;

use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Academic\Entities\AcaInstructor;
use Modules\Academic\Entities\AcaStudent;
use Spatie\Permission\Models\Role;

class ContactList extends Component
{
    public $students = [];
    public $instructors = [];
    public $is_instructor = false;

    public function mount()
    {
        $this->loadData();
    }

    public function render()
    {

        return view('chat::livewire.contact-list');
    }

    public function loadData()
    {
        $person = Person::where('user_id', Auth::id())->first();
        $person_id = null;
        if ($person) {
            $person_id = $person->id;
        }

        $courses_i = AcaInstructor::where('person_id', $person_id)->get();
        $courses_s = AcaStudent::where('person_id', $person_id)->get();

        $course_iids = [];
        $course_sids = [];

        if ($courses_i) {
            foreach ($courses_i as $k => $course) {
                $course_iids[$k] = $course->course_id;
            }
        }

        if ($courses_s) {
            foreach ($courses_s as $k => $course) {
                $course_sids[$k] = $course->course_id;
            }
        }

        $this->students = AcaStudent::join('people', 'person_id', 'people.id')
            ->join('users', 'user_id', 'users.id')
            ->select(
                'users.id',
                'users.is_online',
                'users.avatar',
                'people.full_name',
                'people.email',
                'users.chat_last_activity'
            )
            ->whereIn('course_id', $course_iids)
            ->where('people.id', '<>', $person_id)
            ->groupBy([
                'users.id',
                'users.is_online',
                'users.avatar',
                'people.full_name',
                'people.email',
            ])
            ->get();

        $this->instructors = AcaInstructor::join('people', 'person_id', 'people.id')
            ->join('users', 'user_id', 'users.id')
            ->select(
                'users.id',
                'users.is_online',
                'users.avatar',
                'people.full_name',
                'people.email',
                'users.chat_last_activity'
            )
            ->whereIn('course_id', $course_sids)
            ->where('people.id', '<>', $person_id)
            ->groupBy([
                'users.id',
                'users.is_online',
                'users.avatar',
                'people.full_name',
                'people.email',
            ])
            ->get();

        $role_id = DB::table('model_has_roles')->where('model_type', User::class)->where('model_id', Auth::user()->id)->first()->role_id;
        if (Role::find($role_id)->name == "Instructor"){
            $this->is_instructor=true;
        }
    }

    public function reloadData()
    {
        echo 'dddddd';
    }
}
