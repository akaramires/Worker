<?php

    class AclController extends BaseController
    {
        public function index ()
        {
            $users = User::withTrashed()->orderBy('role_id')->where('role_id', '!=', '4')->orderBy('first_name')->get();

            return View::make('acl.index')
                ->with('page_title', 'Developers')
                ->with('users', $users);
        }

        public function create ()
        {   $roles= Role::all()->lists('name', 'id');
            return View::make('acl.create')
                ->with('roles', $roles)
                ->with('page_title', 'Add user');
        }

        public function edit ($id)
        {
            $user = User::find($id);
            $roles= Role::all()->lists('name', 'id');
            if ($user && $user->role_id != 4) {
                return View::make('acl.edit')
                    ->with('page_title', 'Edit user')
                    ->with('roles', $roles)
                    ->with('user', $user);
            }

            Session::flash('errorMsg', 'You do not have access to edit this user.');

            return Redirect::route('users.index');
        }

        public function update ($id)
        {
            $rules = User::$rules;
            $rules['username'] .= ",id,$id";
            $rules['email'] .= ",id,$id";

            if (!strlen(Input::get('password')) && !strlen(Input::get('password_confirmation'))) {
                unset($rules['password']);
                unset($rules['password_confirmation']);
            }

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return Redirect::route('users.edit', array('id' => $id))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $user = User::find($id);

                if ($user && $user->role_id != 4) {
                    $user->first_name = Input::get('first_name');
                    $user->last_name  = Input::get('last_name');
                    $user->username   = Input::get('username');
                    $user->email      = Input::get('email');
                    $user->password   = Hash::make(Input::get('password'));
                    $user->role_id    = Input::get('role_id');
                    $user->save();

                    Session::flash('successMsg', 'Successfully updated user!');
                } else {
                    Session::flash('errorMsg', 'You do not have access to edit this user.');
                }

                return Redirect::route('users.index');
            }
        }

        public function store ()
        {
            $validator = Validator::make(Input::all(), User::$rules);

            if ($validator->fails()) {
                return Redirect::route('users.create')
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $user             = new User;
                $user->first_name = Input::get('first_name');
                $user->last_name  = Input::get('last_name');
                $user->username   = Input::get('username');
                $user->email      = Input::get('email');
                $user->password   = Hash::make(Input::get('password'));
                $user->role_id    = Input::get('role_id');




                $user->save();

                Session::flash('successMsg', 'Successfully created user!');

                return Redirect::route('users.index');
            }
        }

        public function destroy ($id)
        {
            if (Input::get('restore') != null && Input::get('restore') == 1 && Input::get('force') == null) {
                $user = User::onlyTrashed()->where('id', '=', $id)->firstOrFail();
                if ($user && $user->role_id != 4) {
                    if (!in_array($user->role_id, array(1, 2))) {
                        $user->restore();

                        Session::flash('successMsg', 'Successfully restored the user!');

                        return Redirect::route('users.index');
                    }
                }

                Session::flash('errorMsg', 'You do not have access to restore this user.');
            } elseif (Input::get('force') != null && Input::get('force') == 1 && Input::get('restore') == null) {
                $user = User::onlyTrashed()->find($id);
                if ($user && $user->role_id != 4) {
                    if (!in_array($user->role_id, array(1, 2))) {
                        $user->forceDelete();

                        Session::flash('successMsg', 'Successfully deleted the user!');

                        return Redirect::route('users.index');
                    }
                }

                Session::flash('errorMsg', 'You do not have access to delete this user.');
            } elseif (Input::get('force') == null && Input::get('restore') == null) {
                $user = User::find($id);

                if ($user && $user->role_id != 4) {
                    if (!in_array($user->role_id, array(1, 2))) {
                        $user->delete();

                        Session::flash('successMsg', 'Successfully deactivated the user!');

                        return Redirect::route('users.index');
                    }
                }

                Session::flash('errorMsg', 'You do not have access to delete this user.');
            }

            return Redirect::route('users.index');
        }
    }
