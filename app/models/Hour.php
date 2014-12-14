<?php

/**
 * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
 * @copyright (C)Copyright 2014 eatech.org
 * Date: 12/13/14
 * Time: 3:11 PM
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Class Hour
 *
 * @property      int      $id
 * @property      string   $description
 * @property      int      $count
 * @property      string   $date
 * @property      string   $deleted_at
 * @property      string   $created_at
 * @property      string   $updated_at
 * @property-read \User    $user
 * @property-read \Project $project
 */
class Hour extends Eloquent
{

    use SoftDeletingTrait;

    protected $table = 'hours';

    public static $rules = array(
        'hours_date'        => 'required|date|before:"now"',
        'hours_project'     => 'required|integer|min:1',
        'hours_task'        => 'required|integer|min:1',
        'hours_count'       => 'required|numeric|min:1|max:8',
        'hours_description' => 'required',
    );


    public function user ()
    {
        return $this->belongsTo('User');
    }

    public function project ()
    {
        return $this->belongsTo('Project');
    }
}