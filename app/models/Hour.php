<?php

    /**
     * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
     *
     * @copyright (C)Copyright 2014 eatech.org
     *               Date: 12/13/14
     *               Time: 3:11 PM
     */

    use Illuminate\Database\Eloquent\SoftDeletingTrait;

    /**
 * Class Hour
 *
 * @property integer        $id
 * @property integer        $user_id
 * @property integer        $project_id
 * @property string         $description
 * @property float          $count
 * @property string         $date
 * @property string         $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \User     $user
 * @property-read \Project  $project
 * @method static \Illuminate\Database\Query\Builder|\Hour whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Hour whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Hour whereProjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\Hour whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Hour whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\Hour whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Hour whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Hour whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Hour whereUpdatedAt($value)
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


        public function user()
        {
            return $this->belongsTo('User');
        }

        public function project()
        {
            return $this->belongsTo('Project');
        }
    }