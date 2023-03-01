<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LogoutController;
use App\Models\SessionHistory;
use App\Models\User;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SingleSessionMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $userId = Auth::id();
        $sessionId = $request->session()->getId();

        $activeSession = SessionHistory::where('user_id', $userId)
            ->where('session_id', '<>', $sessionId)
            ->whereNull('logout_time')
            ->first();

        if ($activeSession) {
            return redirect()->route('logout');
        }

        // Si no hay una sesión activa con el mismo token de sesión,
        // se permite que el middleware continúe y se actualiza la tabla
        // session_histories con el nuevo token de sesión para la sesión actual.


        return $next($request);
    }




    public function logout()
    {
        if (auth()->check()) {
            $date = new DateTime();
            $date->modify('-5 minute');
            $new_date = $date->format('Y-m-d H:i:s');

            User::find(Auth::id())->update([
                'is_online' => false,
                'chat_last_activity' => $new_date
            ]);

            $sessionId = Session::getId();

            SessionHistory::where('session_id', $sessionId)
                ->where('user_id', Auth::id())
                ->delete();
        }
        // dd(Auth::user());
        return redirect('login')->with(Auth::logout());
    }
}
