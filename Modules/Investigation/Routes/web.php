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

Route::middleware(['auth:sanctum', 'verified'])->prefix('investigation')->group(function() {
    Route::middleware(['middleware' => 'role_or_permission:investigacion'])->get('dashboard', 'InvestigationController@index')->name('investigation_dashboard');
    Route::group(['prefix' => 'parts'], function() {
        Route::middleware(['middleware' => 'role_or_permission:investigacion_partes'])->get('list', 'PartsController@index')->name('investigation_parts');
    });

    Route::group(['prefix' => 'universities'], function() {
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos'])->get('list', 'UniversitiesController@list')->name('Investigation_universities_list');
    });

    Route::group(['prefix' => 'universities'], function() {
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos'])->get('edit/{id}', 'UniversitiesController@edit')->name('Investigation_universities_edit');
    });

    Route::group(['prefix' => 'universities'], function() {
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos'])->get('create', 'UniversitiesController@create')->name('Investigation_universities_create');
    });

    Route::group(['prefix' => 'universities'], function() {
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos'])->get('schools', 'UniversitiesController@schools')->name('Investigation_universities_schools');
    });

});
