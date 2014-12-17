<?php

    class AclController extends BaseController
    {
        public function index()
        {
            $users = User::where('role_id', '=', 3)->withTrashed()->orderBy('first_name')->get();

            return View::make('acl.index')
                ->with('page_title', 'Users')
                ->with('users', $users);
        }

        public function create()
        {
            return View::make('acl.create')
                ->with('page_title', 'Add user');
        }

        public function edit($id)
        {
            $user = User::find($id);

            if ($user) {
                if (!in_array($user->role_id, array(1, 2))) {
                    return View::make('acl.edit')
                        ->with('page_title', 'Edit user <b>' . $user->last_name . '</b>')
                        ->with('user', $user);
                }
            }

            Session::flash('errorMsg', 'You do not have access to edit this user.');
            return Redirect::route('users.index');
        }

        public function update($id)
        {
            $rules = User::$rules;
            $rules['username'] .= ",id,$id";
            $rules['email'] .= ",id,$id";

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return Redirect::route('users.edit', array('id' => $id))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $user = User::find($id);

                if ($user) {
                    if (!in_array($user->role_id, array(1, 2))) {
                        $user->first_name = Input::get('first_name');
                        $user->last_name = Input::get('last_name');
                        $user->username = Input::get('username');
                        $user->email = Input::get('email');
                        $user->password = Hash::make(Input::get('password'));
                        $user->save();

                        Session::flash('successMsg', 'Successfully updated user!');
                    }
                } else {
                    Session::flash('errorMsg', 'You do not have access to edit this user.');
                }

                return Redirect::route('users.index');
            }
        }

        public function store()
        {
            $validator = Validator::make(Input::all(), User::$rules);

            if ($validator->fails()) {
                return Redirect::route('users.create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $user = new User;
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
                $user->username = Input::get('username');
                $user->email = Input::get('email');
                $user->password = Hash::make(Input::get('password'));
                $user->role_id = 3;
                $user->save();

                Session::flash('successMsg', 'Successfully created user!');
                return Redirect::route('users.index');
            }
        }

        public function destroy($id)
        {
            if (Input::get('restore') != null && Input::get('restore') == 1) {
                $user = User::onlyTrashed()->where('id', '=', $id)->firstOrFail();
                if ($user) {
                    if (!in_array($user->role_id, array(1, 2))) {
                        $user->restore();

                        Session::flash('successMsg', 'Successfully restored the user!');
                        return Redirect::route('users.index');
                    }
                }

                Session::flash('errorMsg', 'You do not have access to restore this user.');
            } else {
                $user = User::find($id);

                if ($user) {
                    if (!in_array($user->role_id, array(1, 2))) {
                        $user->delete();

                        Session::flash('successMsg', 'Successfully deleted the user!');
                        return Redirect::route('users.index');
                    }
                }

                Session::flash('errorMsg', 'You do not have access to delete this user.');
            }

            return Redirect::route('users.index');
        }
    }
