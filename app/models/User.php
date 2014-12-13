<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait, SoftDeletingTrait;

    protected $table = 'users';

    protected $hidden = array('password', 'remember_token');

    public static $rules = array(
        'first_name'            => 'required|alpha|min:3',
        'last_name'             => 'required|alpha|min:1',
        'username'              => 'required|unique:users',
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|alpha_num|between:6,12|confirmed',
        'password_confirmation' => 'required|alpha_num|between:6,12'
    );

    /**
     * A user will belong to many permissions.
     */
    public function permissions ()
    {
        return $this->belongsToMany('Permission')->withTimestamps();
    }

    public function hasPermissions ($permissions, $requireAll = false)
    {
        // Fetch all of the users permission slugs.
        $userPermissions = array_fetch($this->permissions->toArray(), 'slug');

        // Create an empty array to store the required permissions that the user has.
        $hasPermissions = [];

        // Loop through all of the required permissions.
        foreach ((array)$permissions as $permission) {

            // Check if the required permission is in the userPermissions array.
            if (in_array($permission, $userPermissions)) {

                // Add the permission to the array of required permissions that the user has.
                $hasPermissions[] = $permission;
            }
        }

        // If all permissions are required, check that the user has them all.
        if ($requireAll === true) {
            return $hasPermissions == (array)$permissions;
        }

        // If all are not required, check that the user has at least 1.
        return !empty($hasPermissions);
    }

    public function redirectToOwnPage ()
    {
        $userPermissions = array_fetch($this->permissions->toArray(), 'slug');

        if (sizeof($userPermissions) > 0) {
            $permission = reset($userPermissions);

            switch ($permission) {
                case 'developer':
                    $url = '/';
                    break;
                case 'manager':
                    $url = '/reports';
                    break;
                case 'admin':
                    $url = '/admin';
                    break;
            }

            return Redirect::to($url)->with('errorMsg', 'You don\'t have permission to access the requested page');
        } else {

            return Redirect::to('login');
        }
    }
}