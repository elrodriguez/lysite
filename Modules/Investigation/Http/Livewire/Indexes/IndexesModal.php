<?php

namespace Modules\Investigation\Http\Livewire\Indexes;

use Livewire\Component;

class IndexesModal extends Component
{
    public $thesis_student_id;
    public $type = 0;

    public $items = [];

    public function mount($thesis_student_id)
    {
        $this->thesis_student_id = $thesis_student_id;
    }
    public function render()
    {
        return view('investigation::livewire.indexes.indexes-modal');
    }

    public function activeType($type)
    {
        $this->type = $type;
    }

    public function addTitleIndexNew()
    {
        $prefix = count($this->items) + 1;

        array_push($this->items, [
            'id'            => '',
            'thesis_id'   => '',
            'prefix'  => $prefix,
            'content'   => '',
            'position'   => '',
            'items'         => []
        ]);

        $index = count($this->items) - 1;

        $this->dispatchBrowserEvent('inve-thesis-indexes-item', ['keyItem' => $index]);
    }
}
