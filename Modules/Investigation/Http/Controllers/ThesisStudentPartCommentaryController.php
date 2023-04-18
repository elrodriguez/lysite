<?php

namespace Modules\Investigation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Investigation\Entities\InveThesisStudentPartSelectionComment;
use Illuminate\Validation\Validator;

class ThesisStudentPartCommentaryController extends Controller
{
    public function createComenntarySelection(Request $request)
    {
        $request->validate([
            'thesi_student_part_id' => 'required',
            'thesi_student_id' => 'required',
            'thesi_format_part_id' => 'required',
            'selecction_text' => 'required',
            'selecction_id' => 'required',
            'commentary' => 'required',
        ]);

        InveThesisStudentPartSelectionComment::create([
            'thesis_student_part_id' => $request->get('thesi_student_part_id'),
            'thesis_student_id' => $request->get('thesi_student_id'),
            'thesis_format_part_id' => $request->get('thesi_format_part_id'),
            'selecction_text' => $request->get('selecction_text'),
            'selecction_id' => $request->get('selecction_id'),
            'commentary' => $request->get('commentary'),
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Los datos se han procesado correctamente',
        ]);
    }
}
