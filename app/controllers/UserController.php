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

            return View::make('user/login')
                ->with('page_title', 'Login');
        }

        public function process ()
        {
            if (Auth::attempt(array('username' => Input::get('username'),
                                    'password' => Input::get('password')))
            ) {

                switch (Auth::user()->role->slug) {
                    case 'developer':
                        $url = '/hours';
                        break;
                    case 'manager':
                        $url = '/reports';
                        break;
                    case 'admin':
                        $url = '/admin';
                        break;
                    case 'super':
                        $url = '/admin';
                        break;
                    default:
                        $url = 'login';
                        break;
                }

                return Redirect::to($url)
                    ->with('successMsg', 'You are now logged in!');
            } else {
                return Redirect::to('login')
                    ->with('errorMsg', 'Your username/password combination was incorrect')
                    ->withInput();
            }
        }

        public function logout ()
        {
            Auth::logout();

            return Redirect::to('login');
        }

        public function reset ()
        {
            return View::make("user/reset")->with('page_title', 'Password change');
        }

        public function resetProcess ()
        {
            if (Session::token() !== Input::get('_token')) {
                return Redirect::to('reset')->with('errorMsg', 'Unauthorized attempt to create hours');
            }

            $data = Input::all();

            $validator = Validator::make($data, array(
                'password'              => 'required|alpha_num|between:6,12|confirmed',
                'password_confirmation' => 'required|alpha_num|between:6,12'
            ));

            if ($validator->fails()) {
                return Redirect::to('reset')->withErrors($validator);
            }

            $user           = User::find(Auth::user()->id);
            $user->password = Hash::make($data['password']);
            $user->save();

            return Redirect::to('/')->with('successMsg', 'Your password was successfully changed.');
        }

//        public function set_new_password ()
//        {
//            return View::make('user.set_new_password')
//                ->with('page_title', 'Set new password');
//        }
    }