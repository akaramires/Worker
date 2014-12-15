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
 * @property integer                                               $id
 * @property string                                                $slug
 * @property string                                                $name
 * @property string                                                $description
 * @property string                                                $deleted_at
 * @property \Carbon\Carbon                                        $created_at
 * @property \Carbon\Carbon                                        $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Permission whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Permission whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Permission whereUpdatedAt($value)
 */
    class Permission extends Eloquent
    {

        use SoftDeletingTrait;

        protected $table = 'permissions';

        /**
         * A permission will have many users.
         */
        public function users()
        {
            return $this->hasMany('User')->withTimestamps();
        }

    }