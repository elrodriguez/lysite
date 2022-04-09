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
    public $parts_all; //todas las partes sin filtrar solo ordenados por number order

    public $focus_id;
    public $focused_part;
    /*----  id de la subparte que se requiere ver $focus_id  -----*/

    use WithPagination;
    protected $listeners = ['listParts' => 'updatingListParts'];

    public $search;

    public $format;
    public $parts = [];

    public function mount($thesis_id, $sub_part){
        $this->focus_id = $sub_part;
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
        $this->parts_all = InveThesisFormatPart::where('thesis_format_id', $this->format_id)->orderBy('number_order')->first()->get();
        if($this->focus_id == 0){
            $this->focus_id= $this->parts_all[0]->id;
        }
        $this->focused_part = InveThesisFormatPart::find($this->focus_id);
        //esta es la parte que se mostrará a la derecha de la vista

        $parts = InveThesisFormatPart::where('thesis_format_id',$this->format_id)
            ->whereNull('belongs')
            ->orderBy('number_order')
            ->get();

        foreach($parts as $k => $part){
            $this->parts[$k] = [
                'id' => $part->id,
                'description' => $part->description,
                'information' => $part->information,
                'number_order' => $part->number_order,
                'items' => $this->getSubParts($part->id),
                'body' => $part->body,
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
                $html .= '<button type="button"
                class="btn btn-secondary btn-sm"
                data-toggle="modal"
                data-target=".bd-example-modal-sm">
                <i class="fa fa-video"></i>
                </button>';
                $html .= '<button type="button"
                class="btn btn-secondary btn-sm"
                data-toggle="tooltip"
                title="'.$subpart->information.'"
                data-placement="top">
                <i class="fa fa-info-circle"></i>
                </button>';
                /*
                if($subpart->body){
                    $html .= '<button wire:click="openModalEditTwo('.$subpart->id.')" type="button" class="btn btn-secondary btn-sm">
                                <i class="fa fa-pencil-alt"></i>
                            </button>';
                } */
                $html .= '<a href="'.route('investigation_thesis_parts',[$this->thesis_id,$subpart->id]).'">'.$subpart->number_order.' '.$subpart->description.'</a>';
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

    public function save(){
       /* Aquí debe crearse en la tabla donde se registra la tesis del alumno
       crear o actualizar la tabla de la tesis del alumno

       $part = InveThesisFormatPart::create([
            'thesis_format_id' => $this->format_id,
            'belongs' => $this->part_id,
            'number_order' => $this->number_order,
            'description' => $this->description,
            'information' => $this->information,
            'state' => $this->state,
            'index_order' => $this->index_order,
        ]);
*/
dd($this->format_id);
$this->focused_part->description="la ptm";

        $this->dispatchBrowserEvent('inve-part-create', ['res' => 'success', 'tit' => 'Enhorabuena', 'msg' => 'Se guardó correctamente']);
    }
}
