<?php

namespace Modules\Investigation\Http\Controllers;

use App\Models\Person;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Investigation\Entities\InveThesisFormatPart;
use Modules\Investigation\Entities\InveThesisStudent;
use PDF;

class ThesisController extends Controller
{

    public function index()
    {
        return view('investigation::index');
    }

    public function create()
    {
        return view('investigation::thesis.thesis_create');
    }

    public function edit($id)
    {
        return view('investigation::thesis.thesis_edit')->with('id', $id);
    }

    public function parts($thesis_id, $sub_part = 0)
    {
        //para obtener el ID de la parte con el index_order mas bajo para mostrarlo al inicio cuando no se recibe parametro
        if($sub_part==0){
        $id = InveThesisStudent::where('id',$thesis_id)->get()->first()->format_id;
        $id = InveThesisFormatPart::where('thesis_format_id', $id)->where('belongs', null)->orderBy('index_order', 'ASC')->get()->first()->id;
        $sub_part=$id;
        }

        return view('investigation::thesis.thesis_parts')
            ->with('thesis_id', $thesis_id)
            ->with('sub_part', $sub_part);
    }

    public function exportPDF($thesis_id)
    {
        $thesis = $this->getThesis($thesis_id);
        view()->share('thesis', $thesis);
        $pdf = PDF::loadView('investigation::thesis.thesis_export', $thesis);
        return $pdf->download('archivo-pdf.pdf');
        //return view('investigation::thesis.thesis_export')->with('thesis', $thesis);
    }

    public function getThesis($thesis_id)
    {
        $person = Person::where('user_id', Auth::id())->first();

        $thesis = InveThesisFormatPart::join('inve_thesis_formats', 'inve_thesis_format_parts.thesis_format_id', 'inve_thesis_formats.id')
            ->join('inve_thesis_students', 'inve_thesis_students.format_id', 'inve_thesis_formats.id')
            ->select(
                'inve_thesis_formats.right_margin',
                'inve_thesis_formats.left_margin',
                'inve_thesis_formats.between_lines',
                'inve_thesis_formats.name',
                'inve_thesis_students.title',
                'inve_thesis_format_parts.number_order',
                'inve_thesis_format_parts.description',
                'inve_thesis_format_parts.id',
                'inve_thesis_format_parts.show_description',
                'inve_thesis_students.id AS thesis_id'
            )
            ->selectSub(function ($query) use ($thesis_id) {
                $query->from('inve_thesis_student_parts')
                    ->select('inve_thesis_student_parts.content')
                    ->where('inve_thesis_student_parts.inve_thesis_student_id', $thesis_id)
                    ->whereColumn('inve_thesis_student_parts.inve_thesis_format_part_id', 'inve_thesis_format_parts.id')
                    ->where('inve_thesis_student_parts.state', true);
            }, 'content')
            ->whereRaw('IF(inve_thesis_format_parts.belongs IS NULL OR inve_thesis_format_parts.belongs = "",TRUE, FALSE)')
            ->where('inve_thesis_students.person_id', $person->id)
            ->where('inve_thesis_students.user_id', $person->user_id)
            ->where('inve_thesis_students.id', $thesis_id)
            ->orderBy('index_order')
            ->get();

        $parts = [];
        foreach ($thesis as $k => $part) {
            $parts[$k] = [
                'right_margin' => $part->right_margin,
                'left_margin' => $part->left_margin,
                'between_lines' => $part->between_lines,
                'title' => $part->title,
                'description' => $part->description,
                'content' => html_entity_decode($part->content, ENT_QUOTES, "UTF-8"),
                'number_order' => $part->number_order,
                'show_description' => html_entity_decode($part->show_description, ENT_QUOTES, "UTF-8"),
                'items' => $this->getSubParts($part->id, $part->thesis_id),
            ];
        }

        return $parts;
    }

    public function getSubParts($part_id, $thesis_id)
    {
        $subparts = InveThesisFormatPart::where('belongs', $part_id)
            ->select(
                'inve_thesis_format_parts.id',
                'inve_thesis_format_parts.number_order',
                'inve_thesis_format_parts.description',
                'inve_thesis_format_parts.show_description'
            )
            ->selectSub(function ($query) use ($thesis_id) {
                $query->from('inve_thesis_student_parts')
                    ->select('inve_thesis_student_parts.content')
                    ->where('inve_thesis_student_parts.inve_thesis_student_id', $thesis_id)
                    ->whereColumn('inve_thesis_student_parts.inve_thesis_format_part_id', 'inve_thesis_format_parts.id')
                    ->where('inve_thesis_student_parts.state', true);
            }, 'content')
            ->orderBy('index_order')
            ->get();
        //dd($subparts);
        $html = '';

        if (count($subparts) > 0) {
            $html .= '<ol>';
            foreach ($subparts as $k => $subpart) {
                $html .= '<li class="list-style-type:none">';
                if ($subpart->show_description) {
                    $html .= $subpart->number_order . ' ' . $subpart->description;  //solo se muestra si show_description es verdadero
                }
                $html .= '<div>' . html_entity_decode($subpart->content, ENT_QUOTES, "UTF-8") . '</div>';
                $html .= $this->getSubParts($subpart->id, $thesis_id);
                $html .= '</li>';
            }
            $html .= '</ol>';
        }
        return $html;
    }

    public function allthesis()
    {
        return view('investigation::thesis.thesis_all');
    }
    public function thesischeck($external_id, $part_id = null)
    {
        //para obtener el ID de la parte con el index_order mas bajo para mostrarlo al inicio cuando no se recibe parametro
        if($part_id==0){
            $id = InveThesisStudent::where('external_id',$external_id)->get()->first()->format_id;
            $id = InveThesisFormatPart::where('thesis_format_id', $id)->where('belongs', null)->orderBy('index_order', 'ASC')->get()->first()->id;
            $part_id=$id;
            }
        return view('investigation::thesis.thesis_parts_check')
            ->with('external_id', $external_id)
            ->with('part_id', $part_id);
    }

    public function exportWORD($thesis_id)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $thesis = $this->getThesisWord($thesis_id);

        $section = $phpWord->addSection();

        $content = '';

        $title = '';

        // $view = View::make('investigation::thesis.thesis_export')->with('thesis', $thesis)->render();
        // dd($view);

        foreach ($thesis as $thesi) {
            if ($title != $thesi['title']) {
                $section->addText(
                    $thesi['title'],
                    array('name' => 'Tahoma', 'size' => 14)
                );
                $content .= "<ol>";
                foreach ($thesis as $part) {
                    $part_title = $part['description'];
                    $content .= "<li data-liststyle='upperRoman' data-numId='" . $part['number_order'] . "'>{$part_title}";
                    $content .= '<div>' . html_entity_decode($part['content'], ENT_QUOTES, "UTF-8") . '</div>';
                    $content .= $part['items'];
                    $content .= "</li>";
                }
                $content .= "</ol>";
            }
            $title = $thesi['title'];
        }
        // Add HTML

        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $content, false, false);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');


        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
            dd($e);
        }


        return response()->download(storage_path('helloWorld.docx'));
    }

    public function getThesisWord($thesis_id)
    {
        $person = Person::where('user_id', Auth::id())->first();

        $thesis = InveThesisFormatPart::join('inve_thesis_formats', 'inve_thesis_format_parts.thesis_format_id', 'inve_thesis_formats.id')
            ->join('inve_thesis_students', 'inve_thesis_students.format_id', 'inve_thesis_formats.id')
            ->select(
                'inve_thesis_formats.name',
                'inve_thesis_students.title',
                'inve_thesis_format_parts.number_order',
                'inve_thesis_format_parts.description',
                'inve_thesis_format_parts.id',
                'inve_thesis_format_parts.show_description',
                'inve_thesis_students.id AS thesis_id'
            )
            ->selectSub(function ($query) use ($thesis_id) {
                $query->from('inve_thesis_student_parts')
                    ->select('inve_thesis_student_parts.content')
                    ->where('inve_thesis_student_parts.inve_thesis_student_id', $thesis_id)
                    ->whereColumn('inve_thesis_student_parts.inve_thesis_format_part_id', 'inve_thesis_format_parts.id')
                    ->where('inve_thesis_student_parts.state', true);
            }, 'content')
            ->whereRaw('IF(inve_thesis_format_parts.belongs IS NULL OR inve_thesis_format_parts.belongs = "",TRUE, FALSE)')
            ->where('inve_thesis_students.person_id', $person->id)
            ->where('inve_thesis_students.user_id', $person->user_id)
            ->where('inve_thesis_students.id', $thesis_id)
            ->get();

        $parts = [];
        foreach ($thesis as $k => $part) {
            $parts[$k] = [
                'title' => $part->title,
                'description' => $part->description,
                'content' => $part->content,
                'number_order' => $part->number_order,
                'show_description' => $part->show_description,
                'items' => $this->getSubPartsWord($part->id, $part->thesis_id),
            ];
        }

        return $parts;
    }


    public function getSubPartsWord($part_id, $thesis_id)
    {
        $subparts = InveThesisFormatPart::where('belongs', $part_id)
            ->select(
                'inve_thesis_format_parts.id',
                'inve_thesis_format_parts.number_order',
                'inve_thesis_format_parts.description',
                'inve_thesis_format_parts.show_description'
            )
            ->selectSub(function ($query) use ($thesis_id) {
                $query->from('inve_thesis_student_parts')
                    ->select('inve_thesis_student_parts.content')
                    ->where('inve_thesis_student_parts.inve_thesis_student_id', $thesis_id)
                    ->whereColumn('inve_thesis_student_parts.inve_thesis_format_part_id', 'inve_thesis_format_parts.id')
                    ->where('inve_thesis_student_parts.state', true);
            }, 'content')
            ->orderBy('number_order')
            ->get();
        //dd($subparts);
        $html = '';

        if (count($subparts) > 0) {
            $html .= '<ol>';
            foreach ($subparts as $k => $subpart) {
                $html .= '<li class="list-style-type:none">';
                if ($subpart->show_description) {
                    $html .= $subpart->number_order . ' ' . $subpart->description;
                }
                $html .= '<div>' . html_entity_decode($subpart->content, ENT_QUOTES, "UTF-8") . '</div>';
                $html .= $this->getSubPartsWord($subpart->id, $thesis_id);
                $html .= '</li>';
            }
            $html .= '</ol>';
        }
        return $html;
    }

    public function permissions_thesis_allowed()
    {
        return view('investigation::thesis.thesis_allowed');
    }
}
