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
        Route::middleware(['middleware' => 'role_or_permission:investigacion_partes'])->get('list/{id}', 'PartsController@index')->name('investigation_parts');
    });

    Route::group(['prefix' => 'universities'], function() {
        Route::middleware(['middleware' => 'role_or_permission:universities_list'])->get('list', 'UniversitiesController@list')->name('Investigation_universities_list');
        Route::middleware(['middleware' => 'role_or_permission:universities_edit'])->get('edit/{id}', 'UniversitiesController@edit')->name('Investigation_universities_edit');
        Route::middleware(['middleware' => 'role_or_permission:universities_create'])->get('create', 'UniversitiesController@create')->name('Investigation_universities_create');
        Route::middleware(['middleware' => 'role_or_permission:universities_list'])->get('schools/{id}', 'UniversitiesController@schools')->name('Investigation_universities_schools');
        Route::middleware(['middleware' => 'role_or_permission:universities_create'])->get('schools/create/{id}', 'UniversitiesController@schools_create')->name('Investigation_universities_schools_create');
        Route::middleware(['middleware' => 'role_or_permission:universities_edit'])->get('schools/edit/{university_id}/{school_id}', 'UniversitiesController@schools_edit')->name('Investigation_universities_schools_edit');
    });

    Route::group(['prefix' => 'thesis_formats'], function() {
        Route::middleware(['middleware' => 'role_or_permission:investigacion_partes'])->get('list/{school_id}', 'ThesisFormatsController@list')->name('Investigation_thesis_formats_list');
        Route::middleware(['middleware' => 'role_or_permission:investigacion_partes'])->get('all/formats', 'ThesisFormatsController@list_complete')->name('Investigation_thesis_formats_list_complete');
        Route::middleware(['middleware' => 'role_or_permission:investigacion_partes_nuevo'])->get('create/{school_id}', 'ThesisFormatsController@create')->name('Investigation_thesis_formats_create');
        Route::middleware(['middleware' => 'role_or_permission:investigacion_partes_editar'])->get('edit/{school_id}/{thesis_format_id}', 'ThesisFormatsController@edit')->name('Investigation_thesis_formats_edit');
        Route::middleware(['middleware' => 'role_or_permission:investigacion_partes_nuevo'])->get('create/format/new', 'ThesisFormatsController@create_complete')->name('Investigation_thesis_formats_create_complete');
    });

});