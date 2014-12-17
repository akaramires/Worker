<?php

    Route::get('login', 'UserController@index');
    Route::post('login', 'UserController@process');
    Route::get('logout', 'UserController@logout');
    Route::get('reset', 'UserController@reset');
    Route::post('reset', 'UserController@resetProcess');

    Route::group(array('before' => 'auth'), function () {
        Route::post('/projects/childs', 'ProjectController@childs');
        Route::get('/', function () {
            return Auth::user()->redirectToOwnPage();
        });
    });

    Route::group(array('before' => 'auth|role:developer'), function () {
        Route::delete('/{id}', 'HoursController@destroy');
        Route::any('/{date_from}/{date_to}/{task_id}', 'HoursController@index')
            ->where('date_from', '[0-9]+')
            ->where('date_to', '[0-9]+')
            ->where('task_id', '[0-9]+');
        Route::resource('hours', 'HoursController');
    });

    Route::group(array('before' => 'auth|role:admin'), function () {
        Route::resource('users', 'AclController');
        Route::resource('admin', 'AdminController');
    });

    Route::group(array('before' => 'auth|roles:manager,admin'), function () {
        Route::resource('reports', 'ReportController');
        Route::resource('projects', 'ProjectController');
    });