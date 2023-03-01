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

Route::middleware(['auth:sanctum', 'verified'])->prefix('setting')->group(function () {
    Route::middleware(['single-session'])->group(function () {
        Route::group(['prefix' => 'modules'], function () {
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos'])->get('list', 'ModuleController@index')->name('setting_modules');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos_nuevo'])->get('create', 'ModuleController@create')->name('setting_modules_create');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos_editar'])->get('edit/{id}', 'ModuleController@edit')->name('setting_modules_editar');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos_permisos'])->get('permissions/{id}', 'ModuleController@permissions')->name('setting_modules_permisos');
        });

        Route::group(['prefix' => 'roles'], function () {
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_roles'])->get('list', 'RolesController@index')->name('setting_roles');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_roles_nuevo'])->get('create', 'RolesController@create')->name('setting_roles_create');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_roles_editar'])->get('edit/{id}', 'RolesController@edit')->name('setting_roles_editar');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_roles_permisos'])->get('permissions/{id}', 'RolesController@permissions')->name('setting_roles_permisos');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_usuarios'])->get('list', 'UserController@index')->name('setting_users');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_usuarios_nuevo'])->get('create', 'UserController@create')->name('setting_users_create');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_usuarios_editar'])->get('edit/{id}', 'UserController@edit')->name('setting_users_editar');
        });

        Route::group(['prefix' => 'parameters'], function () {
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_parametros_lista'])->get('list', 'ParametersController@index')->name('setting_parameters');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_parametros_nuevo'])->get('create', 'ParametersController@create')->name('setting_parameters_create');
            Route::middleware(['middleware' => 'role_or_permission:configuraciones_parametros_editar'])->get('edit/{id}', 'ParametersController@edit')->name('setting_parameters_editar');
        });
    });
});
