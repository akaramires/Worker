<?php

/**
 * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
 * @copyright (C)Copyright 2014 eatech.org
 * Date: 12/13/14
 * Time: 3:11 PM
 */

class Permission extends Eloquent
{

    /**
     * A permission will have many users.
     */
    public function users ()
    {
        return $this->hasMany('User')->withTimestamps();
    }

}