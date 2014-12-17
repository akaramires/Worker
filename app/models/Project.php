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
     * Class Project
     *
     * @property integer                                               $id
     * @property integer                                               $parent_id
     * @property string                                                $title
     * @property string                                                $slug
     * @property string                                                $deleted_at
     * @property \Carbon\Carbon                                        $created_at
     * @property \Carbon\Carbon                                        $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\Hour[] $hours
     * @method static \Illuminate\Database\Query\Builder|\Project whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\Project whereParentId($value)
     * @method static \Illuminate\Database\Query\Builder|\Project whereTitle($value)
     * @method static \Illuminate\Database\Query\Builder|\Project whereSlug($value)
     * @method static \Illuminate\Database\Query\Builder|\Project whereDeletedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\Project whereCreatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\Project whereUpdatedAt($value)
     */
    class Project extends Eloquent
    {
        use SoftDeletingTrait;

        protected $table = 'projects';

        public function hours ()
        {
            return $this->hasMany('Hour');
        }

        public function projects ()
        {
            return $this->where('parent_id', '=', $this->id)->get();
        }

        public function hasHoursOrChilds ()
        {
            $isSingle = true;

            if (Project::where('parent_id', '=', $this->id)->count()) {
                $isSingle = false;
            }

            if ($this->hours()->count()) {
                $isSingle = false;
            }

            return !$isSingle;
        }
    }