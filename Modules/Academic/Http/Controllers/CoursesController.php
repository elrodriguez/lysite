<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CoursesController extends Controller
{
    public function index()
    {
        return view('academic::courses.index');
    }

    public function create()
    {
        return view('academic::courses.create');
    }

    public function edit($id)
    {
        return view('academic::courses.edit')->with('id', $id);
    }

    public function instructorCourses(){
        return view('academic::courses.instructor_courses');
    }

<<<<<<< HEAD
    public function instructorCoursesEdit($id){
        return view('academic::courses.instructor_courses_edit')->with('id', $id);
    }

    public function dashinstructorCourses(){
        return view('academic::courses.dash_instructor_courses');
    }

    public function dashinstructorCoursesEdit($id){
        return view('academic::courses.dash_instructor_courses_edit')->with('id', $id);
=======
    public function instructorCoursesEdit($course_id){
        return view('academic::courses.instructor_courses_edit')->with('course_id', $course_id);
>>>>>>> 7be89ee91747b1b8a9ab0cf5a90b40f74a1f6bd1
    }
}
