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
    Route::group(['prefix' => 'courses'], function() {
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos'])->get('list', 'CoursesController@index')->name('academic_courses');
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos_nuevo'])->get('create', 'CoursesController@create')->name('academic_courses_create');
        Route::middleware(['middleware' => 'role_or_permission:academico_cursos_editar'])->get('edit/{id}', 'CoursesController@edit')->name('academic_courses_editar');
        Route::middleware(['middleware' => 'role_or_permission:academico_secciones'])->get('section_list/{course_id}', 'SectionsController@index')->name('academic_sections');
        Route::middleware(['middleware' => 'role_or_permission:academico_secciones_nuevo'])->get('section_create/{course_id}', 'SectionsController@create')->name('academic_sections_create');
        Route::middleware(['middleware' => 'role_or_permission:academico_secciones_editar'])->get('section_edit/{course_id}/{section_id}', 'SectionsController@edit')->name('academic_sections_editar');

        Route::group(['prefix' => 'section/contents'], function() {
            Route::middleware(['middleware' => 'role_or_permission:academico_contenido'])->get('list/{course_id}/{section_id}', 'ContentsController@index')->name('academico_contenido');
            Route::middleware(['middleware' => 'role_or_permission:academico_contenido_nuevo'])->get('create/{section_id}', 'ContentsController@create')->name('academico_contenido_create');
            Route::middleware(['middleware' => 'role_or_permission:academico_contenido_editar'])->get('edit/{section_id}/{content_id}', 'ContentsController@edit')->name('academico_contenido_editar');
        });

    });
    Route::group(['prefix' => 'content_types'], function() {
        Route::middleware(['middleware' => 'role_or_permission:academico_tipo_contenido'])->get('list', 'ContentTypesController@index')->name('academic_content_types');
        Route::middleware(['middleware' => 'role_or_permission:academico_tipo_contenido_nuevo'])->get('create', 'ContentTypesController@create')->name('academic_content_types_create');
        Route::middleware(['middleware' => 'role_or_permission:academico_tipo_contenido_editar'])->get('edit/{id}', 'ContentTypesController@edit')->name('academic_content_types_editar');
    });
});


