<?php

use App\Events\InstructorOnline;
use App\Events\PrivateMessage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\User\UserController;
use App\Models\Person;
use Modules\Investigation\Entities\InveThesisStudentPart;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PaypalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/prueba', function () {

    //dd($roles);
    //return view('prueba');
    // $string = InveThesisStudentPart::where('id', 6)->value('content');
    // $html = html_entity_decode($string, ENT_QUOTES, "UTF-8");
    // dd($html);
    //return $html;
})->name('prueba');

route::get('lista/admin', function () {
    $admins = Person::join('users', 'people.user_id', 'users.id')
        ->join('model_has_roles', function (JoinClause $join) {
            $join->on('model_has_roles.model_id', '=', 'users.id')
                ->where('model_type', User::class)
                ->where('role_id', 1);
        })
        ->select(
            'users.id',
            'users.is_online',
            'users.avatar',
            'people.full_name',
            'people.email',
            'users.chat_last_activity',
            DB::raw('(SELECT MIN(is_seen) FROM chat_messages WHERE user_id = users.id ) AS is_seen')
        )->get();
    dd($admins);
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    //return view('auth.register');
    return view('auth.ly-register');
})->name('register');

Route::get('/home', function () {
    return view('home');
})->name('home_page');

Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['single-session'])->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::middleware(['auth:sanctum', 'verified'])->get('dashboard_courses', [DashboardController::class, 'getCourses'])->name('dashboard_courses');
    Route::middleware(['auth:sanctum', 'verified'])->get('tool/IA/lyon', [DashboardController::class, 'getHelpGPT'])->name('help_gpt');
    Route::middleware(['auth:sanctum', 'verified'])->get('user/edit_account', [UserController::class, 'account'])->name('user_edit_account');
    Route::middleware(['auth:sanctum', 'verified'])->get('user/edit_profile', [UserController::class, 'profile'])->name('user_edit_account_profile');
    Route::middleware(['auth:sanctum', 'verified'])->get('user/edit_password', [UserController::class, 'password'])->name('user_edit_account_password');
    Route::middleware(['auth:sanctum', 'verified'])->get('user/edit_avatar', [UserController::class, 'avatar'])->name('user_edit_account_avatar');
    Route::middleware(['auth:sanctum', 'verified'])->get('tool/worksheet', [DashboardController::class, 'getWorksheet'])->name('worksheet');
});

Route::get('/modo', function () {
    return view('ly_modo');
})->name('modo_page');

Route::get('/unirme/{mod}', function ($mod) {
    return view('ly_join', ['mod' => $mod]);
})->name('unirme_page');

Route::get('/tarjeta/{mod}', function ($mod) {
    $precio = 0;
    if ($mod == 'standar') {
        $precio = 500;
    } else if ($mod == 'premiun') {
        $precio = 700;
    } else {
        $precio = 0;
    }
    return view('ly_tarjeta', [
        'precio' => $precio
    ]);
})->name('tarjeta_page');


/* PayPal */
Route::post('/paypal/payment', [PaypalController::class, 'payment'])->name('paypal_payment');
Route::get('/paypal/success/{paymentId}', [PaypalController::class, 'success'])->name('paypal_success');
Route::get('/paypal/cancel/{paymentId}', [PaypalController::class, 'cancel'])->name('paypal_cancel');

require __DIR__ . '/auth.php';
