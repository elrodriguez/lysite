<?php

namespace Modules\Investigation\Http\Livewire\Thesis;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormat;
use Modules\Investigation\Entities\InveThesisFormatPart;
use Modules\Investigation\Entities\InveThesisStudent;
use Modules\Investigation\Entities\InveThesisStudentPart;

class ThesisPartsCheck extends Component
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
    public $auto_save = true;
    public $thesisStudentPart;
    public $commentary;

    public $notes;

    public function mount($external_id, $part_id)
    {
        $this->focus_id = $part_id;
        $this->thesis_id = $external_id;
        $this->thesis_student = InveThesisStudent::where('external_id', $external_id)->first();

        if ($this->thesis_student) {
            $this->auto_save = $this->thesis_student->autosave;
            $this->format_id = $this->thesis_student->format_id;
            $this->format == InveThesisFormat::find($this->format_id);

            $this->thesisStudentPart = InveThesisStudentPart::where('inve_thesis_student_id', $this->thesis_student->id)
                ->where('inve_thesis_format_part_id', $this->focus_id)
                ->orderBy('version', 'desc')
                ->limit(1)
                ->first();

            if ($this->thesisStudentPart) {
                $this->content_old = html_entity_decode($this->thesisStudentPart->content, ENT_QUOTES, "UTF-8");
                $this->content = $this->content_old;
                $this->commentary = $this->thesisStudentPart->commentary;
            }
        } else {
            redirect()->route('home');
        }
    }

    public function render()
    {
        $this->getParts();
        return view('investigation::livewire.thesis.thesis-parts-check');
    }

    public function getParts()
    {
        $this->parts_all = InveThesisFormatPart::where('thesis_format_id', $this->format_id)->orderBy('number_order')->get();

        if ($this->focus_id == 0) {
            $this->focus_id = $this->parts_all[0]->id;
        }
        $this->focused_part = InveThesisFormatPart::find($this->focus_id);
        //esta es la parte que se mostrará a la derecha de la vista

        $parts = InveThesisFormatPart::where('thesis_format_id', $this->format_id)
            ->whereNull('belongs')
            ->orderBy('number_order')
            ->get();

        foreach ($parts as $k => $part) {
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
    public function getSubParts($id)
    {
        $subparts = InveThesisFormatPart::where('belongs', $id)
            ->orderBy('number_order')
            ->get();
        $html = '';

        if (count($subparts) > 0) {
            $html .= '<ul>';
            foreach ($subparts as $k => $subpart) { //$this->thesis_id,$subpart->id
                if ($this->focus_id == $subpart->id) {
                    $html .= '<li class="active">';
                    $html .= '<li class="alert alert-primary">';
                    $html .= '<a class="alert-link" href="' . route('investigation_thesis_check', [$this->thesis_id, $subpart->id]) . '">' . $subpart->number_order . ' ' . $subpart->description . '</a>';
                    $html .= $this->getSubParts($subpart->id);
                    $html .= '</li>';
                } else {
                    $html .= '<li class="active">';
                    $html .= '<li>';
                    $html .= '<a href="' . route('investigation_thesis_check', [$this->thesis_id, $subpart->id]) . '">' . $subpart->number_order . ' ' . $subpart->description . '</a>';
                    $html .= $this->getSubParts($subpart->id);
                    $html .= '</li>';
                }
            }
            $html .= '</ul>';
        }
        return $html;
    }

    public function save()
    {
        if($this->thesisStudentPart!=null){ // si existe actualiza de lo contrario deberá crear con los datos del alumno
            $this->thesisStudentPart->update([
                'content' => htmlentities($this->content, ENT_QUOTES, "UTF-8"),
                'commentary_user_id' => Auth::id(),
                'commentary' => $this->commentary
            ]);
        }else{
            InveThesisStudentPart::create([
                'student_id' => $this->thesis_student->student_id,
                'inve_thesis_student_id' => $this->thesis_student->id,
                'inve_thesis_format_part_id' => $this->focus_id,
                'content' => htmlentities($this->content, ENT_QUOTES, "UTF-8"),
                'commentary_user_id' => Auth::id(),
                'commentary' => $this->commentary,
                //     'version' => ($max_version ? $max_version + 1 : 1)
            ]);
        }


        $this->dispatchBrowserEvent('inve-student-part-create', ['success' => true]);
    }
}
