<?php

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

Route::middleware(['auth:sanctum', 'verified'])->prefix('setting')->group(function() {
    Route::group(['prefix' => 'modules'], function() {
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos'])->get('list', 'ModuleController@index')->name('setting_modules');
    });
});
