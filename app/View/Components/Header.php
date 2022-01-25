<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Modules\Academic\Entities\AcaCourse;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class header extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $courses;

    protected $listeners = ['CoursesOpenModal' => 'openModalCourses'];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

       return view('components.header', ['courses' => $this->getCourses()]);
    }
    public function getCourses()
    {
        $this->courses=DB::table('Aca_courses')->get();
        return $this->courses;
    }


}
