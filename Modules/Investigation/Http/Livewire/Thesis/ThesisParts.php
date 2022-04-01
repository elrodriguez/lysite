<?php

namespace Modules\Investigation\Http\Livewire\Thesis;

use App\Models\Universities;
use App\Models\UniversitiesSchools;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Investigation\Entities\InveThesisFormat;
use Modules\Investigation\Entities\InveThesisFormatPart;
use Modules\Investigation\Entities\InveThesisStudent;

class ThesisParts extends Component
{
    public $thesis_id;
    public $university;
    public $school;
    public $thesis_format;
    public $thesis_student;
    /* ------------------------------------------------------------------------- */
    public $part_id;
    public $format_id;
    public $part;
    public $number_order;
    public $description;
    public $information;
    public $state;
    public $index_order;

    use WithPagination;
    protected $listeners = ['listParts' => 'updatingListParts'];

    public $search;

    public $format;
    public $parts = [];

    public function mount($thesis_id){
        $this->thesis_id = $thesis_id;
        $this->thesis_student = InveThesisStudent::find($thesis_id);
        $this->format_id = $this->thesis_student->format_id;
        $this->format == InveThesisFormat::find($thesis_id);
    }

    public function render()
    {
        $this->getParts();
        return view('investigation::livewire.thesis.thesis-parts');
    }

    public function updatingListParts()
    {
        $this->resetPage();
    }

    public function getParts(){
        $parts = InveThesisFormatPart::where('thesis_format_id',$this->format_id)
            ->whereNull('belongs')
            ->orderBy('number_order')
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
            ->orderBy('number_order')
            ->get();
        $html = '';

        if(count($subparts)>0){
            $html .= '<ul>';
            foreach($subparts as $k => $subpart){
                $html .= '<li>';
                $html .= '<div class="btn-group mr-3">
                            <button wire:click="openModalTwo('.$subpart->id.')" type="button" class="btn btn-secondary btn-sm">
                                <i class="fa fa-plus"></i>
                            </button>
                            <button wire:click="openModalEditTwo('.$subpart->id.')" type="button" class="btn btn-secondary btn-sm">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button onclick="deletes('.$subpart->id.')" type="button" class="btn btn-secondary btn-sm">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </div>';
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

    public function openModalEditTwo($id){
        $this->emit('openModalPartEditForm',$id);
    }

    public function destroy($id){
        try {
            InveThesisFormatPart::find($id)->delete();
            $res = 'success';
            $tit = 'Enhorabuena';
            $msg = 'Se eliminó correctamente';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
            $tit = 'Salió mal';
            $msg = 'No se puede eliminar porque cuenta con registros asociados';
        }

        $this->dispatchBrowserEvent('inve-part-delete', ['res' => $res, 'tit' => $tit, 'msg' => $msg]);
    }
}
