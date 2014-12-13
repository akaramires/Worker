<?php

/**
 * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
 * @copyright (C)Copyright 2014 eatech.org
 * Date: 12/13/14
 * Time: 3:11 PM
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Hour extends Eloquent
{

    use SoftDeletingTrait;

    protected $table = 'hours';

    public function user ()
    {
        return $this->belongsTo('User');
    }

    public function project ()
    {
        return $this->belongsTo('Project');
    }
}