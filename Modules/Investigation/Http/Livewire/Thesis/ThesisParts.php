<?php

namespace Modules\Investigation\Http\Livewire\Thesis;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Academic\Entities\AcaContent;
use Modules\Investigation\Entities\InveThesisFormat;
use Modules\Investigation\Entities\InveThesisFormatPart;
use Modules\Investigation\Entities\InveThesisStudent;
use Modules\Investigation\Entities\InveThesisStudentPart;

class ThesisParts extends Component
{
    public $thesis_id;
    public $university;
    public $school;
    public $thesis_format;
    public $thesis_student;

    public $parts_all; //todas las partes sin filtrar solo ordenados por number order

    public $focus_id;
    public $focused_part;

    public $format;
    public $parts = [];

    public $content;
    public $content_old;

    public function mount($thesis_id, $sub_part){
        $this->focus_id = $sub_part;
        $this->thesis_id = $thesis_id;

        $this->thesis_student = InveThesisStudent::find($thesis_id);
        $this->format_id = $this->thesis_student->format_id;
        $this->format == InveThesisFormat::find($thesis_id);

        $ThesisStudentPart = InveThesisStudentPart::where( 'inve_thesis_student_id', $this->thesis_student->id)
        ->where('inve_thesis_format_part_id', $this->focus_id)
        ->orderBy('version', 'desc')
        ->limit(1)
        ->first();

        if($ThesisStudentPart){
            $this->content_old = html_entity_decode($ThesisStudentPart->content, ENT_QUOTES, "UTF-8");
        }
        
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
            $this->focus_id = $this->parts_all[0]->id;
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

    public function saveThesisPartStudentN(){
       
        $this->validate([
            'content' => 'required'
        ]);

        $max_version = InveThesisStudentPart::where( 'inve_thesis_student_id', $this->thesis_student->id)
            ->where('inve_thesis_format_part_id', $this->focus_id)
            ->max('version');

        InveThesisStudentPart::create([
            'student_id' => $this->thesis_student->student_id,
            'inve_thesis_student_id' => $this->thesis_student->id,
            'inve_thesis_format_part_id' => $this->focus_id,
            'content' => htmlentities($this->content, ENT_QUOTES, "UTF-8"),
            'version' => ($max_version ? $max_version + 1 : 1)
        ]);

        $this->dispatchBrowserEvent('inve-student-part-create', ['res' => 'success', 'tit' => 'Enhorabuena', 'msg' => 'Se guardó correctamente']);
    }

    public function goEdit($thesis_id){
        redirect()->route('investigation_thesis_edit',$thesis_id);
    }
    public function deleteThesis($id){
        try {
            InveThesisStudent::find($id)->delete();
            $res = 'success';
            $tit = 'Enhorabuena';
            $msg = 'Se eliminó correctamente';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
            $tit = 'Salió mal';
            $msg = 'No se puede eliminar porque cuenta con registros asociados';
        }

        $this->dispatchBrowserEvent('inve-thesis-delete', ['res' => $res, 'tit' => $tit, 'msg' => $msg]);
    }

    public function showVideo(){

        $content_id = $this->focused_part->content_id;
        $success = false;
        $video = null;

        if($content_id){
            $success = true;
            $url = AcaContent::where('id',$content_id)->value('content_url');
            $video = str_replace('https://vimeo.com/','', $url);
        }

        $this->dispatchBrowserEvent('inve-open-modal-video', ['success' => $success, 'video' => $video]);
    }
}
