<?php

namespace Modules\Investigation\Http\Livewire\Thesis;

use Livewire\Component;

class ThesisParts extends Component
{
    public $thesis_id;

    public function mount($thesis_id){
        $this->thesis_id = $thesis_id;
    }
    
    public function render()
    {
        return view('investigation::livewire.thesis.thesis-parts');
    }
}
