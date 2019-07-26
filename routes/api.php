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


Route::group(['middleware' => 'auth:api'], function(){

    Route::resources([
        'admin' => 'Api\AdminController',
    ]);
});
