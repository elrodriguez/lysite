<?php

namespace Modules\Investigation\Http\Livewire\Thesis;

use Livewire\Component;
use Modules\Investigation\Entities\InveThesisStudent;

class HeaderInvestigation extends Component
{
    public $thesis = [];

    protected $listeners = ['updateThesisList' => 'getThesis'];

    public function render()
    {
        $this->getThesis();
        return view('investigation::livewire.thesis.header-investigation');
    }

    public function getThesis(){
        $this->thesis = InveThesisStudent::all();
    }
    
    public function goParts($thesis_id){
        redirect()->route('investigation_thesis_parts',$thesis_id);
    }

    public function goEdit($thesis_id){
        redirect()->route('investigation_thesis_edit',$thesis_id);
    }
    public function deleteThesis($id){
        try {
            InveThesisStudent::find($id)->delete();
            $res = 'success';
            $tit = 'Enhorabuena';
            $msg = 'Se eliminó correctamente';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
            $tit = 'Salió mal';
            $msg = 'No se puede eliminar porque cuenta con registros asociados';
        }

        $this->dispatchBrowserEvent('inve-thesis-delete', ['res' => $res, 'tit' => $tit, 'msg' => $msg]);
    }

    public function dashboard_next(){
        
        redirect()->route('dashboard');
    }
}
