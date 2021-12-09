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

    public function destroy($id){
        try {
            AcaSection::find($id)->delete();
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
