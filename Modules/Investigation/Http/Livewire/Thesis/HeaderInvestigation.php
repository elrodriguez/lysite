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
}
