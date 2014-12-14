<?php

Route::get('login', 'UserController@index');
Route::post('login', 'UserController@process');
Route::get('logout', 'UserController@logout');

Route::group(array('before' => 'auth'), function () {
    Route::post('/tasks', 'HomeController@tasks');
    Route::delete('/{id}', 'HomeController@destroy');
    Route::resource('/', 'HomeController');
});
Route::group(array('before' => 'permission:admin'), function () {
    Route::resource('admin', 'AdminController');
});

Route::group(array('before' => 'permission:manager'), function () {
    Route::resource('reports', 'ReportController');
});