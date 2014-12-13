<?php

Route::get('login', 'UserController@index');
Route::post('login', 'UserController@process');
Route::get('logout', 'UserController@logout');

Route::group(['before' => 'auth'], function () {

    Route::get('/', function () {
        return 'You have reached the admin dashboard.';
    });

    Route::get('admin', ['before' => 'permission:admin', function () {
        return 'You have reached the admin page.';
    }]);

    Route::get('reports', ['before' => 'permission:manager', function () {
        return 'You have reached the manager page.';
    }]);

});