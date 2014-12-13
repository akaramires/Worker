<?php

/**
 * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
 * @copyright (C)Copyright 2014 eatech.org
 * Date: 12/13/14
 * Time: 5:30 PM
 */
class UserController extends BaseController
{
    public function index ()
    {
        Auth::logout();

        return View::make('login');
    }

    public function process ()
    {
        if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
            return Redirect::intended('admin');
        }

        return App::abort(401);
    }

    public function logout ()
    {
        Auth::logout();

        return Redirect::to('login');
    }
}