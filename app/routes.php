<?php

    Route::get('login', 'UserController@index');
    Route::post('login', 'UserController@process');
    Route::get('logout', 'UserController@logout');
    Route::get('reset', 'UserController@reset');
    Route::post('reset', 'UserController@resetProcess');

    Route::group(array('before' => 'role:developer'), function () {
        Route::post('/tasks', 'HomeController@tasks');
        Route::delete('/{id}', 'HomeController@destroy');
        Route::any('/{date_from}/{date_to}/{task_id}', 'HomeController@index')
            ->where('date_from', '[0-9]+')
            ->where('date_to', '[0-9]+')
            ->where('task_id', '[0-9]+');
        Route::resource('/', 'HomeController');
    });

    Route::group(array('before' => 'role:admin'), function () {
        Route::resource('admin', 'AdminController');
    });

    Route::group(array('before' => 'role:manager'), function () {
        Route::resource('reports', 'ReportController');
    });