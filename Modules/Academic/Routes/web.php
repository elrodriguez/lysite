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

Route::middleware(['auth:sanctum', 'verified'])->prefix('academic')->group(function() {
    Route::group(['prefix' => 'modules'], function() {
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos'])->get('list', 'CoursesController@index')->name('academic_courses');
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos_nuevo'])->get('create', 'CoursesController@create')->name('academic_courses_create');
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos_editar'])->get('edit/{id}', 'CoursesController@edit')->name('academic_courses_editar');
    });
    Route::group(['prefix' => 'content_types'], function() {
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos'])->get('list', 'ContentTypesController@index')->name('academic_content_types');
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos_nuevo'])->get('create', 'ContentTypesController@create')->name('academic_content_types_create');
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos_editar'])->get('edit/{id}', 'ContentTypesController@edit')->name('academic_content_types_editar');
    });
});

