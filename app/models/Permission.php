<?php

/**
 * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
 *
 * @copyright (C)Copyright 2014 eatech.org
 * Date: 12/13/14
 * Time: 3:11 PM
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Class Permission
 *
 * @property      int                                                 $id
 * @property      string                                              $slug
 * @property      string                                              $name
 * @property      string                                              $description
 * @property      string                                              $deleted_at
 * @property      string                                              $created_at
 * @property      string                                              $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[]    $users
 */
class Permission extends Eloquent
{

    use SoftDeletingTrait;

    protected $table = 'permissions';

    /**
     * A permission will have many users.
     */
    public function users ()
    {
        return $this->hasMany('User')->withTimestamps();
    }

}