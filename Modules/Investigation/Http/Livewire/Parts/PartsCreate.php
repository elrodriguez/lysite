<?php

namespace Modules\Investigation\Http\Livewire\Parts;

use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormat;
use Modules\Investigation\Entities\InveThesisFormatPart;

class PartsCreate extends Component
{
    protected $listeners = ['openModalPartCreate' => 'openModalPart'];

    public $part_id;
    public $format_id;

    public $index_id;
    public $description;
    public $information;
    public $state;

    public function render()
    {
        return view('investigation::livewire.parts.parts-create');
    }

    public function openModalPart($format_id, $part_id = null){
        $this->format_id = $format_id;
        $this->part_id = $part_id;
        $title = 'Nueva Parte';
        
        if($this->part_id){
            $part = InveThesisFormatPart::find($this->part_id);
            $title = 'Nueva SubParte :' . $part->description;
        }
        $this->dispatchBrowserEvent('open-modal-parts', ['title' => $title]);
    }

    public function savePart(){
        $this->validate([
            'index_id' => 'required|unique:inve_thesis_format_parts,id',
            'description' => 'required|string|max:255',
            'information' => 'required|string'
        ]);

        InveThesisFormatPart::create([
            'description' => $this->description,
            'information' => $this->information,
            'number_order' => $this->index_id,
            'thesis_format_id' => $this->format_id,
            'belongs' => $this->part_id,
            'state' => $this->state ? true : false
        ]);

        $this->dispatchBrowserEvent('inve-parts-save', ['tit' => 'Enhorabuena','msg' => 'Se registró correctamente']);
    }
}
