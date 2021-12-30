<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index(/*$course_id*/)
    {
        return view('academic::students.index');
        //return view('academic::students.students')->with('course_id',$course_id);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(/*$course_id*/)
    {
        return view('academic::students.create');
        //return view('academic::students.students-assign')->with('course_id',$course_id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(/*$course_id, */$id)
    {
        return view('academic::students.edit')->with('id', $id);
        /*
        return view('academic::students.student-assign-edit')->with([

            'course_id' => $course_id,
            'id' => $id
        ]); */
    }


}
