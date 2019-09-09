<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function () {
    return view('admin');
});

//Route::get('/test','Api\PersonController@test')->name('person.test');
Route::get('/test','Web\TestController@index')->name('test');
