<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasrole('Admin')) {
            return view('dashboard.dashboard_admin');
        } elseif (Auth::user()->hasrole('Student')) {
            if (Person::where('user_id', Auth::user()->id)->exists()) {
                return view('dashboard.dashboard_student');
            } else {
                return view('user.edit_information');
            }
        } elseif (Auth::user()->hasrole('Instructor')) {
            return view('dashboard.dashboard_instructor');
        }
    }
    public function getCourses()
    {
        return view('dashboard.dashboard_ly_student_courses');
    }
    public function getHelpGPT()
    {
        return view('helpGPT.ly_help_gpt');
    }
    public function getWorksheet()
    {
        return view('ly_worksheet');
    }
}
