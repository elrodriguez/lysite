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
use App\Models\TypeSubscription;
use App\Http\Controllers\DniController;
use App\Models\UserSubscription;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

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
    Route::middleware(['auth:sanctum', 'verified'])->get('tool/worksheet/{thesis_id}/{sub_part?}', [DashboardController::class, 'getWorksheet'])->name('worksheet');


    Route::middleware(['auth:sanctum', 'verified'])->get('/tarjeta/{mod}', function ($mod) {

        $sus = TypeSubscription::find($mod);
        $preference_id = null;
        // use MercadoPago\Client\Preference\PreferenceClient;
        // use MercadoPago\Client\Payment\PaymentClient;
        try {
            \MercadoPago\MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_TOKEN'));

            $client = new \MercadoPago\Client\Preference\PreferenceClient();

            $us = UserSubscription::create([
                'date_start' => \Carbon\Carbon::now()->format('Y-m-d'),
                'date_end' => \Carbon\Carbon::now()->addMonth()->format('Y-m-d'),
                'user_id' => Auth::id(),
                'subscription_id' => $sus->id,
                'status' => false,
                'status_response' => null,
                'payment_response' => null
            ]);

            $preference = $client->create([
                "items" => array(
                    array(
                        "title" => $sus->name,
                        "quantity" => 1,
                        "unit_price" => floatval($sus->price)
                    )
                )
            ]);

            $preference_id =  $preference->id;
        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            // Manejar la excepción
            $response = $e->getApiResponse();
            dd($response); // Mostrar la respuesta para obtener más detalles
        }

        return view('ly_tarjeta', [
            'preference_id' => $preference_id,
            'price' => $sus->price,
            'us_id' => $us->id
        ]);
    })->name('tarjeta_page');

    ///////////procesar pago//////////
    Route::middleware(['auth:sanctum', 'verified'])->put('/process_payment/{id}', function ($id) {
        \MercadoPago\MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_TOKEN'));

        $client = new \MercadoPago\Client\Payment\PaymentClient();

        try {

            $payment = $client->create([
                "token" => request()->get('token'),
                "issuer_id" => request()->get('issuer_id'),
                "payment_method_id" => request()->get('payment_method_id'),
                "transaction_amount" => (float) request()->get('transaction_amount'),
                "installments" => request()->get('installments'),
                "payer" => request()->get('payer')
            ]);

            $us = UserSubscription::find($id);

            if ($payment->status == 'approved') {

                $us->status_response = $payment->status;
                $us->payment_response = json_encode($payment);
                $us->save();

                return response()->json([
                    'status' => $payment->status,
                    'message' => $payment->status_detail,
                    'url' => route('web_gracias_por_comprar_tu_entrada', $us->id)
                ]);
            } else {

                return response()->json([
                    'status' => $payment->status,
                    'message' => $payment->status_detail,
                    'url' => route('modo_page')
                ]);

                $us->delete();
            }
        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            // Manejar la excepción
            $response = $e->getApiResponse();
            $content  = $response->getContent();

            $message = $content['message'];
            return response()->json(['error' => 'Error al procesar el pago: ' . $message], 412);
        }
    })->name('web_process_payment');

    Route::post('/tarjeta/success', function ($id) {
        ///pagina de agradeciemiento
        dd($id);
    })->name('web_gracias_por_comprar');
});

Route::get('/modo', function () {
    $modos = TypeSubscription::limit(3)->get();
    return view('ly_modo', [
        'modos' => $modos
    ]);
})->name('modo_page');

Route::get('/unirme/{mod}', function ($mod) {
    $typeSubscription = TypeSubscription::find($mod)->name;
    return view('ly_join', ['mod' => $mod, 'typeSubscription' => $typeSubscription]);
})->name('unirme_page');




/* PayPal */
Route::post('/paypal/payment', [PaypalController::class, 'payment'])->name('paypal_payment');
Route::get('/paypal/success/{paymentId}/{type_subscription_id}', [PaypalController::class, 'success'])->name('paypal_success');
Route::get('/paypal/cancel/{paymentId}', [PaypalController::class, 'cancel'])->name('paypal_cancel');

require __DIR__ . '/auth.php';


/* RUTAS DEL YISUS - Provisional */
Route::get('/thanks', [DashboardController::class, 'thanks'])->name('thanks');


//DNI RUTAS
Route::get('/test/consulta/dni/{dni}', [DniController::class, 'consultaDni'])->name('dni_consulta');
