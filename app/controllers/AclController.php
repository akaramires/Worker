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

            return View::make('acl.edit')
                ->with('page_title', 'Edit user <b>' . $user->last_name . '</b>')
                ->with('user', $user);
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
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
                $user->username = Input::get('username');
                $user->email = Input::get('email');
                $user->password = Hash::make(Input::get('password'));
                $user->save();

                Session::flash('successMsg', 'Successfully updated user!');
                return Redirect::route('users.index');
            }
        }

        public function store()
        {
            //            $rules = array(
            //                'title'     => 'required',
            //                'parent_id' => 'required|numeric',
            //            );
            //
            //            $validator = Validator::make(Input::all(), $rules);
            //
            //            if ($validator->fails()) {
            //                return Redirect::route('projects.create')
            //                    ->withErrors($validator)
            //                    ->withInput();
            //            } else {
            //                $project = new Project;
            //                $project->title = Input::get('title');
            //                $project->parent_id = Input::get('parent_id');
            //                $project->save();
            //
            //                Session::flash('successMsg', 'Successfully created project!');
            //                return Redirect::route('projects.index');
            //            }
        }

        public function destroy($id)
        {
            if (Input::get('restore') != null && Input::get('restore') == 1) {
                $user = User::onlyTrashed()->where('id', '=', $id)->firstOrFail();
                $user->restore();

                Session::flash('successMsg', 'Successfully restored the user!');
                return Redirect::route('users.index');
            } else {
                $user = User::find($id);
                $user->delete();

                Session::flash('successMsg', 'Successfully deleted the user!');
                return Redirect::route('users.index');
            }
        }
    }
