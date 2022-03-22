<?php

namespace Modules\Investigation\Http\Livewire\Parts;

use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormatPart;

class PartsList extends Component
{

    public function render()
    {
        return view('investigation::livewire.parts.parts-list',['parts' => $this->getParts()]);
    }

    public function getParts(){
        return InveThesisFormatPart::whereNull('belongs')->paginate(10);
    }
}
