<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function account(){
        return view('user.edit_information');
    }
    public function profile(){
        return view('user.edit_profile');
    }
}
