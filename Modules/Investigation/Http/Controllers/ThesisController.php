<?php

namespace Modules\Investigation\Http\Controllers;

use App\Models\Person;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Investigation\Entities\InveThesisFormatPart;
use Modules\Investigation\Entities\InveThesisStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        if ($sub_part == 0) {
            $format_id = InveThesisStudent::where('id', $thesis_id)->get()->first()->format_id;

            $part = InveThesisFormatPart::where('thesis_format_id', $format_id)->where('belongs', null)->orderBy('index_order', 'ASC')->get()->first();
            if ($part) {
                $sub_part = $part->id;
            }
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
        return $pdf->download('Mi_Tesis_Lysite-pdf.pdf');
        //return view('investigation::thesis.thesis_export')->with('thesis', $thesis);
    }

    public function getThesis($thesis_id)
    {
        $person = Person::where('user_id', Auth::id())->first();

        $thesis = InveThesisFormatPart::join('inve_thesis_formats', 'inve_thesis_format_parts.thesis_format_id', 'inve_thesis_formats.id')
            ->join('inve_thesis_students', 'inve_thesis_students.format_id', 'inve_thesis_formats.id')
            ->select(
                'inve_thesis_formats.between_lines',
                'inve_thesis_formats.top_margin',
                'inve_thesis_formats.bottom_margin',
                'inve_thesis_formats.name',
                'inve_thesis_students.title',
                'inve_thesis_format_parts.number_order',
                'inve_thesis_format_parts.description',
                'inve_thesis_format_parts.id',
                'inve_thesis_format_parts.show_description',
                'inve_thesis_format_parts.salto_de_pagina',
                'inve_thesis_students.id AS thesis_id'
            )
            ->selectSub(function ($query) use ($thesis_id) {
                $query->from('inve_thesis_student_parts')
                    ->select('inve_thesis_student_parts.content')
                    ->where('inve_thesis_student_parts.inve_thesis_student_id', $thesis_id)
                    ->whereColumn('inve_thesis_student_parts.inve_thesis_format_part_id', 'inve_thesis_format_parts.id')
                    ->where('inve_thesis_student_parts.state', true);
            }, 'content')
            ->selectSub(function ($query) use ($thesis_id) {
                $query->from('inve_thesis_student_parts')
                    ->select('inve_thesis_student_parts.right_margin')
                    ->where('inve_thesis_student_parts.inve_thesis_student_id', $thesis_id)
                    ->whereColumn('inve_thesis_student_parts.inve_thesis_format_part_id', 'inve_thesis_format_parts.id')
                    ->where('inve_thesis_student_parts.state', true);
            }, 'right_margin')
            ->selectSub(function ($query) use ($thesis_id) {
                $query->from('inve_thesis_student_parts')
                    ->select('inve_thesis_student_parts.left_margin')
                    ->where('inve_thesis_student_parts.inve_thesis_student_id', $thesis_id)
                    ->whereColumn('inve_thesis_student_parts.inve_thesis_format_part_id', 'inve_thesis_format_parts.id')
                    ->where('inve_thesis_student_parts.state', true);
            }, 'left_margin')
            ->whereRaw('IF(inve_thesis_format_parts.belongs IS NULL OR inve_thesis_format_parts.belongs = "",TRUE, FALSE)')
            ->where('inve_thesis_students.person_id', $person->id)
            ->where('inve_thesis_students.user_id', $person->user_id)
            ->where('inve_thesis_students.id', $thesis_id)
            ->orderBy('index_order')
            ->get();


        // OBteniendo el margen de InveThesisStudents si fue modificado
        $tesis_student = InveThesisStudent::where('id', $thesis_id)->get()->first();
        if ($tesis_student->right_margin != null) {
            $thesis[0]->right_margin = $tesis_student->right_margin;
        }
        if ($tesis_student->left_margin != null) {
            $thesis[0]->left_margin = $tesis_student->left_margin;
        }

        $parts = [];
        foreach ($thesis as $k => $part) {
            $parts[$k] = [
                'right_margin' => $part->right_margin,
                'left_margin' => $part->left_margin,
                'top_margin' => $part->top_margin,
                'bottom_margin' => $part->bottom_margin,
                'between_lines' => $part->between_lines,
                'title' => $part->title,
                'description' => $part->description,
                'content' => html_entity_decode($part->content, ENT_QUOTES, "UTF-8"),
                'number_order' => $part->number_order,
                'show_description' => $part->show_description,
                'salto_de_pagina'    => $part->salto_de_pagina,
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
                'inve_thesis_format_parts.show_description',
                'inve_thesis_format_parts.salto_de_pagina'
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
                //salto de página debe ir al principio
                if ($subpart->salto_de_pagina) {
                    $html .= '<div class="page-break" style="page-break-after:always;"><span style="display:none;">&nbsp;</span></div>';
                }
                $html .= '<li style="list-style:none;padding: 0;">';
                if ($subpart->show_description) {
                    $html .= $subpart->number_order . ' ' . $subpart->description;  //solo se muestra si show_description es verdadero
                }
                $html .= '<div style="padding: 0;margin:0">' . html_entity_decode($subpart->content, ENT_QUOTES, "UTF-8") . '</div>';
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
        if ($part_id == 0) {
            $id = InveThesisStudent::where('external_id', $external_id)->get()->first()->format_id;
            $id = InveThesisFormatPart::where('thesis_format_id', $id)->where('belongs', null)->orderBy('index_order', 'ASC')->get()->first()->id;
            $part_id = $id;
        }
        return view('investigation::thesis.thesis_parts_check')
            ->with('external_id', $external_id)
            ->with('part_id', $part_id);
    }
    public function exportWORDView($thesis_id)
    {
        $thesis = $this->getThesis($thesis_id);
        return view('investigation::thesis.thesis_export_word')->with('thesis', $thesis);
    }
    public function exportWORD($thesis_id)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();
        $thesis = $this->getThesisWord($thesis_id);
        $content = '';

        $title = '';

        // $view = View::make('investigation::thesis.thesis_export')->with('thesis', $thesis)->render();
        // dd($thesis);
        //$seccion->addPageBreak();

        foreach ($thesis as $k => $thesi) {

            if ($title != $thesi['title']) {
                $content .= "<ol>";
                foreach ($thesis as $part) {
                    $part_title = null;
                    if ($part['show_description']) {
                        $part_title = $part['description'];
                    }

                    $content .= "<li>{$part_title}";
                    if ($part['content']) {
                        $str = html_entity_decode($part['content'], ENT_QUOTES, "UTF-8");
                        //$str = str_replace(["\r\n", "\n", "\r"], '', $str);
                        $content .= "<br/><div>" . $str . "</div>";
                    }
                    $content .= $part['items'];
                    $content .= "</li>";
                }
                $content .= "</ol>";
            }
            $title = $thesi['title'];
        }
        // Add HTML
        // First replace new lines by spaces
        //dd($content);
        //$content = str_replace(["\r\n", "\n", "\r"], '', $content);
        // Extract UL from LI an place after
        //dd($content);

        //dd($content);
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
                'inve_thesis_students.short_name',
                'inve_thesis_students.title',
                'inve_thesis_format_parts.number_order',
                'inve_thesis_format_parts.description',
                'inve_thesis_format_parts.id',
                'inve_thesis_format_parts.show_description',
                'inve_thesis_format_parts.salto_de_pagina',
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
                'short_name' => $part->short_name,
                'title' => $part->title,
                'description' => $part->description,
                'content' => $part->content,
                'number_order' => $part->number_order,
                'show_description' => $part->show_description,
                'salto_de_pagina' => $part->salto_de_pagina,
                'items' => $this->getSubPartsWord($part->id, $part->thesis_id),
            ];

            if ($parts[$k]['salto_de_pagina']) {
                $parts[$k]['content'] .= '<pagebreak></pagebreak>';
                // $parts[$k]['content'] .= '<div class="page-break" style="page-break-after:always;"><span style="display:none;">&nbsp;</span></div>';

            }
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
                'inve_thesis_format_parts.show_description',
                'inve_thesis_format_parts.salto_de_pagina'
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
            $html .= "<ol>";
            foreach ($subparts as $k => $subpart) {

                if ($subpart->salto_de_pagina) {
                    $html .= '<div class="page-break" style="page-break-after:always;"><span style="display:none;">&nbsp;</span></div>';
                }
                $html .= '<li class="list-style-type:none">';
                if ($subpart->show_description) {
                    $html .= $subpart->number_order . ' ' . $subpart->description;
                }
                if ($subpart->content) {
                    $str = html_entity_decode($subpart->content, ENT_QUOTES, "UTF-8");
                    $str = str_replace(["\r\n", "\n", "\r"], '', $str);
                    $html .= "<div>" . html_entity_decode($subpart->content, ENT_QUOTES, "UTF-8") . "</div>";
                }

                $html .= $this->getSubPartsWord($subpart->id, $thesis_id);
                $html .= "</li>";
            }
            $html .= "</ol>";
        }
        return $html;
    }

    public function permissions_thesis_allowed()
    {
        return view('investigation::thesis.thesis_allowed');
    }
    public function uploadImage(Request $request)
    {
        $file = $request->file('upload');
        //obtenemos el nombre del archivo
        //$extension = $file->getClientOriginalExtension();
        $file_name =  str_replace(' ', '_', $file->getClientOriginalName());

        // //indicamos que queremos guardar un nuevo archivo en el disco local
        $path = $request->file('upload')->storeAs(
            'thesis',
            $file_name,
            'public'
        );
        $funcNum = 1;
        $message = '';
        $url =  asset('storage/' . $path);
        echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message')</script>";
    }
}
