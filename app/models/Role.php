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
 * Class Role
 *
 * @property integer                                               $id
 * @property string                                                $slug
 * @property string                                                $name
 * @property string                                                $deleted_at
 * @property \Carbon\Carbon                                        $created_at
 * @property \Carbon\Carbon                                        $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Role whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Role whereUpdatedAt($value)
 */
    class Role extends Eloquent
    {

        use SoftDeletingTrait;

        protected $table = 'roles';

        public function users ()
        {
            return $this->hasMany('User', 'role_id')->withTrashed();
        }

    }