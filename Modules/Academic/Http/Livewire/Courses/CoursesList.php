<?php

namespace Modules\Academic\Http\Livewire\Courses;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Academic\Entities\AcaCourse;
use Illuminate\Support\Facades\Storage;

class CoursesList extends Component
{
    public $search;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function getSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('academic::livewire.courses.courses-list',['courses' => $this->getData()]);
    }

    public function getData(){
        return AcaCourse::where('name','like','%'.$this->search.'%')
            ->paginate(10);
    }

    public function destroy($id){
        try {
            $course_image=AcaCourse::find($id)->course_image;
            Storage::disk('public')->delete(substr($course_image, 8));
            AcaCourse::find($id)->delete();
            $res = 'success';
            $tit = 'Enhorabuena';
            $msg = 'Se eliminó correctamente';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
            $tit = 'Salió mal';
            $msg = 'No se puede eliminar porque cuenta con registros asociados';
        }

        $this->dispatchBrowserEvent('set-module-delete', ['res' => $res, 'tit' => $tit, 'msg' => $msg]);
    }
}
