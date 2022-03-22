<?php

namespace Modules\Investigation\Http\Livewire\Parts;

use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormat;
use Modules\Investigation\Entities\InveThesisFormatPart;
use Livewire\WithPagination;
class PartsList extends Component
{
    use WithPagination;
    protected $listeners = ['listParts' => 'updatingListParts'];

    public $search;

    public $format;
    public $format_id;
    public $parts;

    public function mount($format_id){
        $this->format_id = $format_id;
        $this->format == InveThesisFormat::find($format_id);
    }

    public function render()
    {
        $this->getParts();
        return view('investigation::livewire.parts.parts-list');
    }

    public function updatingListParts()
    {
        $this->resetPage();
    }

    public function getParts(){
        $parts = InveThesisFormatPart::where('thesis_format_id',$this->format_id)
            ->whereNull('belongs')
            ->get();

        foreach($parts as $k => $part){
            $this->parts[$k] = [
                'id' => $part->id,
                'description' => $part->description,
                'number_order' => $part->number_order,
                'items' => $this->getSubParts($part->id),
            ];
        }
        
    }
    public function getSubParts($id){
        $subparts = InveThesisFormatPart::where('belongs',$id)
            ->get();
        $html = '';

        if(count($subparts)>0){
            $html .= '<ul>';
            foreach($subparts as $k => $subpart){
                $html .= '<li>';
                $html .= '<button wire:click="openModalTwo('.$subpart->id.')" type="button" class="btn btn-secondary btn-sm mr-3">
                            <i class="fa fa-plus"></i>
                        </button>';
                $html .= $subpart->number_order.' '.$subpart->description;
                $html .= $this->getSubParts($subpart->id);
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    public function openModalTwo($id){
        $this->emit('openModalPartCreate',$this->format_id,$id);
    }
}
