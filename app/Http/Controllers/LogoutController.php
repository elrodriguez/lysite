<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(){
        if (auth()->check()) {
            $date = new DateTime();
            $date->modify('-5 minute');
            $new_date = $date->format('Y-m-d H:i:s');

            User::find(Auth::id())->update([
                'is_online' => false,
                'chat_last_activity' => $new_date
            ]);
        }
        return redirect('login')->with(Auth::logout());
    }
}
