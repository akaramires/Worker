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

Route::get('admin', [
    'before' => 'auth',
    'uses'   => 'AdminController@index',
    'as'     => 'admin'
]);

Route::get('admin/users', [
    'before' => 'auth|permission:user-manager',
    'uses'   => 'Admin\UsersController@index',
    'as'     => 'admin.user'
]);

Route::get('admin/accounts', [
    'before' => 'auth|permission:user-manager,accounts-manager',
    'uses'   => 'Admin\AccountsController@index',
    'as'     => 'admin.accounts'
]);

Route::get('admin/accounts/users', [
    'before' => 'auth|permissions:user-manager,accounts-manager',
    'uses'   => 'Admin\AccountsUsersController@index',
    'as'     => 'admin.accounts.user'
]);

Route::filter('permission', function ($route, $request, $value) {
    $permissions = func_get_args();
    array_shift($permissions);
    array_shift($permissions);

    if (!Auth::user()->hasPermissions($permissions)) {
        return App::abort(401);
    }
});

Route::filter('permissions', function ($route, $request, $value) {
    $permissions = func_get_args();
    array_shift($permissions);
    array_shift($permissions);

    if (!Auth::user()->hasPermissions($permissions, true)) {
        return App::abort(401);
    }
});

Route::group(['prefix' => 'admin', 'before' => 'auth'], function () {
    // No permissions required.
    Route::get('/', function () {
        return 'You have reached the admin dashboard.';
    });

    // User must have post-editor OR content-editor permissions.
    Route::get('posts', [
        'before' => 'permission:post-editor,content-editor',
        function () {
            return 'You have reached the posts page.';
        }
    ]);

    // User must have content-editor permission.
    Route::get('media', [
        'before' => 'permission:content-editor',
        function () {
            return 'You have reached the media page.';
        }
    ]);

    // Userm ust have post-editor AND content-editor permissions.
    Route::get('posts/media', [
        'before' => 'permissions:post-editor,content-editor',
        function () {
            return 'You have reached the post media page.';
        }
    ]);
});