<?php

namespace Modules\Homepage\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('homepage::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
   public function instructors(){
         return view('homepage::home.instructors');
   }

   public function histories(){
         return view('homepage::home.histories');
   }
}
