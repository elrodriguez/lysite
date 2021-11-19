<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\User\UserController;
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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('user/edit_account', [UserController::class, 'account'])->name('user_edit_account');
Route::middleware(['auth:sanctum', 'verified'])->get('user/edit_profile', [UserController::class, 'profile'])->name('user_edit_account_profile');
Route::middleware(['auth:sanctum', 'verified'])->get('user/edit_password', [UserController::class, 'password'])->name('user_edit_account_password');

require __DIR__.'/auth.php';