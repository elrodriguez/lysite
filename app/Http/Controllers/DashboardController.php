<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()->hasrole('Admin')){
            return view('dashboard.dashboard_admin');
        }elseif(Auth::user()->hasrole('Student')){
            return view('dashboard.dashboard_student');
        }elseif(Auth::user()->hasrole('Instructor')){
           dd('falta');
        }
    }
}
