<?php

namespace Modules\Investigation\Http\Livewire\Parts;

use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormat;
use Modules\Investigation\Entities\InveThesisFormatPart;

class PartsList extends Component
{

    public $search;

    public $format;
    public $format_id;

    public function mount($format_id){
        $this->format_id = $format_id;
        $this->format == InveThesisFormat::find($format_id);
    }

    public function render()
    {
        return view('investigation::livewire.parts.parts-list');
    }

    
}
