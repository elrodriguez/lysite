<?php

namespace Modules\Investigation\Http\Livewire\Modals;

use Livewire\Component;

class HelpWithTitle extends Component
{
    public $resultado;
    public function render()
    {
        return view('investigation::livewire.modals.help-with-title');
    }
}
