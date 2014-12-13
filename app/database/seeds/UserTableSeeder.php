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
        DB::table('permission_user')->delete();
        DB::table('permissions')->delete();
        DB::table('users')->delete();

        $permissions = array(
            'admin'     => 'Administrator',
            'manager'   => 'Project Manager',
            'developer' => 'Developer',
        );

        $users = array(
            array(
                'first_name' => 'Admin',
                'last_name'  => 'Admin',
                'username'   => 'admin',
                'email'      => 'email4devs@gmail.com',
                'password'   => Hash::make('admin'),
                'active'     => 1,
                'role'       => array(1),
            ),
            array(
                'first_name' => 'Project',
                'last_name'  => 'Manager',
                'username'   => 'manager',
                'email'      => 'email4devs+1@gmail.com',
                'password'   => Hash::make('temp'),
                'active'     => 0,
                'role'       => array(2),
            ),
            array(
                'first_name' => 'Elmar',
                'last_name'  => 'Abdurayimov',
                'username'   => 'akaramires',
                'email'      => 'e.abdurayimov@gmail.com',
                'password'   => Hash::make('temp'),
                'active'     => 0,
                'role'       => array(3),
            ),
        );

        foreach ($permissions as $slug => $title) {
            $permission       = new Permission;
            $permission->name = $title;
            $permission->slug = $slug;
            $permission->save();
        }

        foreach ($users as $user) {
            $userModel             = new User;
            $userModel->first_name = $user['first_name'];
            $userModel->last_name  = $user['last_name'];
            $userModel->username   = $user['username'];
            $userModel->email      = $user['email'];
            $userModel->password   = $user['password'];
            $userModel->active     = $user['active'];
            $userModel->save();

            $userModel->permissions()->sync($user['role']);
            $userModel->save();
        }
    }
}
