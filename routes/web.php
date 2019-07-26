<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function () {
    return view('admin');
});

Route::get('/test','Api\PersonController@test');
