<?php

namespace Modules\Investigation\Http\Controllers;

use App\Models\Person;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Investigation\Entities\InveThesisFormatPart;
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
                'inve_thesis_formats.name',
                'inve_thesis_students.title',
                'inve_thesis_format_parts.number_order',
                'inve_thesis_format_parts.description',
                'inve_thesis_format_parts.id',
                'inve_thesis_students.id AS thesis_id'
            )
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
                'number_order' => $part->number_order,
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
                'inve_thesis_format_parts.description'
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
            $html .= '<ul>';
            foreach ($subparts as $k => $subpart) {
                $html .= '<li>';
                $html .= $subpart->number_order . ' ' . $subpart->description;
                $html .= '<div>' . html_entity_decode($subpart->content, ENT_QUOTES, "UTF-8") . '</div>';
                $html .= $this->getSubParts($subpart->id, $thesis_id);
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    public function allthesis()
    {
        return view('investigation::thesis.thesis_all');
    }
    public function thesischeck($external_id, $part_id = null)
    {
        return view('investigation::thesis.thesis_parts_check')
            ->with('external_id', $external_id)
            ->with('part_id', $part_id);
    }

    public function exportWORD($thesis_id)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $thesis = $this->getThesis($thesis_id);

        $section = $phpWord->addSection();

        $content = '';

        $title = '';
        $multilevelNumberingStyleName = 'multilevel';

        foreach ($thesis as $thesi) {
            if ($title != $thesi['title']) {
                $section->addText(
                    $thesi['title'],
                    array('name' => 'Tahoma', 'size' => 14)
                );
                $content .= "<ul>";
                foreach ($thesis as $part) {
                    $part_title = $part['number_order'] . ' ' . $part['description'];
                    $content .= "<li style='list-style:none; font-size:12px;'>{$part_title}";
                    $content .= $part['items'];
                    $content .= "</li>";
                }
                $content .= "</ul>";
            }
            $title = $thesi['title'];
        }
        // Add HTML
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $content, false, false);
        //$this->assertCount(7, $section->getElements());

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');


        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
            dd($e);
        }


        return response()->download(storage_path('helloWorld.docx'));
    }

    public function permissions_thesis_allowed(){
        return view('investigation::thesis.thesis_allowed');
    }
}
