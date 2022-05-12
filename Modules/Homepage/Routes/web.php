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


Route::middleware(['auth:sanctum', 'verified'])->prefix('homepage')->group(function() {
    Route::group(['prefix' => 'settings'], function() {

        Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos'])->get('list', 'HomepageController@index')->name('homepage_settings');

        Route::group(['prefix' => 'instructors'], function() {
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos'])->get('list', 'HomepageController@instructors')->name('homepage_instructors');
        });

        Route::group(['prefix' => 'histories'], function() {
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos'])->get('list', 'HomepageController@histories')->name('homepage_histories');
        });
    });
});
