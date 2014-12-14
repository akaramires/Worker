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
 * Class Project
 *
 * @property      int                                              $id
 * @property      int                                              $parent_id
 * @property      string                                           $title
 * @property      string                                           $slug
 * @property      string                                           $deleted_at
 * @property      string                                           $created_at
 * @property      string                                           $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hour[] $hours
 */
class Project extends Eloquent
{

    use SoftDeletingTrait;

    protected $table = 'projects';

    public function hours ()
    {
        return $this->hasMany('Hour');
    }

}