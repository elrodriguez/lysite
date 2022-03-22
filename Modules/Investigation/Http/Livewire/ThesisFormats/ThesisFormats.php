<?php

namespace Modules\Investigation\Http\Livewire\ThesisFormats;

use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormat;
use Livewire\WithPagination;

class ThesisFormats extends Component
{
    public $search;
    public $school_id;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function mount($school_id)
    {
        $this->school_id = $school_id;
    }

    public function getSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('investigation::livewire.thesis-formats.thesis-formats',['formats' => $this->getData(), 'school_id' => $this->school_id]);
    }

    public function getData(){
        return InveThesisFormat::where('name','like','%'.$this->search.'%')
            ->paginate(10);
    }

    public function destroy($id){
        try {
            /*
            $course_image=AcaCourse::find($id)->course_image;
            Storage::disk('public')->delete(substr($course_image, 8)); */
            InveThesisFormat::find($id)->delete();
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
