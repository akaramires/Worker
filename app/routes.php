<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function () {
    return View::make('hello');
});

Route::get('/start', function () {
    $subscriber       = new Role();
    $subscriber->name = 'Subscriber';
    $subscriber->save();

    $author       = new Role();
    $author->name = 'Author';
    $author->save();

    $read               = new Permission();
    $read->name         = 'can_read';
    $read->display_name = 'Can Read Posts';
    $read->save();

    $edit               = new Permission();
    $edit->name         = 'can_edit';
    $edit->display_name = 'Can Edit Posts';
    $edit->save();

    $subscriber->attachPermission($read);
    $author->attachPermission($read);
    $author->attachPermission($edit);

    $user1 = User::find(1);
    $user2 = User::find(2);

    $user1->attachRole($subscriber);
    $user2->attachRole($author);

    return 'Woohoo!';
});