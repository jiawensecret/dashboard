<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/person','Api\PersonController@store')->name('person.store');

Route::post('/admin/login','Api\AdminController@login');

Route::group(['middleware' => 'auth:api'], function(){

    Route::get('/admin/info','Api\AdminController@info');

    Route::resources([
        'admin' => 'Api\AdminController',
        'permission' => 'Api\PermissionController',
        'role' => 'Api\RoleController',
    ]);
});
