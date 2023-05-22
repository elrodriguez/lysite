<?php

namespace Modules\Investigation\Http\Livewire\Thesis;

use Livewire\Component;

class ThesisFormatModal extends Component
{
    public $parts = [];

    public function render()
    {
        return view('investigation::livewire.thesis.thesis-format-modal');
    }

    public function addTitlePart()
    {
        array_push($this->parts, [
            'number_order'  => '',
            'description'   => ''
        ]);
        $index = count($this->parts) - 1;
        $this->dispatchBrowserEvent('inve-thesis-student-format-add', ['keytitle' => $index]);
    }
}
