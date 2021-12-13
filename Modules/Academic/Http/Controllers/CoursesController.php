<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('academic::courses.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('academic::courses.create');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('academic::courses.edit')->with('id', $id);
    }

    public function instructorCourses(){
        return view('academic::courses.instructor_courses');
    }

    public function instructorCoursesEdit(){
        return view('academic::courses.instructor_courses_edit');
    }
}
