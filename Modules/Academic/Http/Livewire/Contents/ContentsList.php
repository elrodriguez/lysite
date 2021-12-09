<?php

namespace Modules\Academic\Http\Livewire\Contents;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Academic\Entities\AcaContent;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaSection;
use PhpParser\Node\Stmt\Label;
use SebastianBergmann\Environment\Console;

class ContentsList extends Component
{
    public $search;
    public $section_id;
    public $course_id;
    public $course;
    public $section;


    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function mount($course_id, $section_id){
        $this->course_id = $course_id;
        $this->section_id = $section_id;
        $this->course = AcaCourse::find($course_id);
        $this->section = AcaSection::find($section_id);
    }

    public function getSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
                return view('academic::livewire.contents.contents-list',['contents' => $this->getSections()]);  // ['contents' => es la variable que va a la vista

            }

    public function getSections(){
        return AcaContent::where('section_id', $this->section_id)->paginate(10);
    }
    public function getData(){
        return AcaContent::where('content_url','like','%'.$this->search.'%')
                        ->paginate(10);
    }
    /*
    ->whereColumn('membership.user_id', 'users.id')*/

    public function destroy($id){
        try {
            AcaContent::find($id)->delete();
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
