<?php

    /**
     * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
     * @copyright (C)Copyright 2014 eatech.org
     * Date: 12/13/14
     * Time: 12:36 AM
     */
    class UserTableSeeder extends Seeder
    {

        public function run ()
        {
            DB::table('roles')->delete();
            DB::table('users')->delete();

            $roles = array(
                'admin'     => 'Administrator',
                'manager'   => 'Project Manager',
                'developer' => 'Developer',
            );

            $users = array(
                array(
                    'first_name' => 'Admin',
                    'last_name'  => 'Admin',
                    'username'   => 'admin',
                    'email'      => 'e.abdurayimov+1@gmail.com',
                    'password'   => Hash::make('admin'),
                    'active'     => 1,
                    'role'       => 1,
                ),
                array(
                    'first_name' => 'Project',
                    'last_name'  => 'Manager',
                    'username'   => 'manager',
                    'email'      => 'e.abdurayimov+2@gmail.com',
                    'password'   => Hash::make('temp'),
                    'active'     => 0,
                    'role'       => 2,
                ),
                array(
                    'first_name' => 'Elmar',
                    'last_name'  => 'Abdurayimov',
                    'username'   => 'akaramires',
                    'email'      => 'e.abdurayimov@gmail.com',
                    'password'   => Hash::make('temp'),
                    'active'     => 0,
                    'role'       => 3,
                ),
                array(
                    'first_name' => 'Test',
                    'last_name'  => 'Test',
                    'username'   => 'test',
                    'email'      => 'test@gmail.com',
                    'password'   => Hash::make('test'),
                    'active'     => 0,
                    'role'       => 3,
                ),
            );

            $roleModels = array();
            foreach ($roles as $slug => $title) {
                $role         = new Role;
                $role->name   = $title;
                $role->slug   = $slug;
                $roleModels[] = $role->save();
            }

            foreach ($users as $user) {
                $userModel             = new User;
                $userModel->first_name = $user['first_name'];
                $userModel->last_name  = $user['last_name'];
                $userModel->username   = $user['username'];
                $userModel->email      = $user['email'];
                $userModel->password   = $user['password'];
                $userModel->active     = $user['active'];
                $userModel->role_id    = $user['role'];
                $userModel->save();
            }
        }
    }
