<?php

namespace Modules\Investigation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
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
        return view('investigation::thesis.thesis_edit')->with('id',$id);
    }

    public function parts($id)
    {
        return view('investigation::thesis.thesis_parts')->with('id',$id);
    }

}
