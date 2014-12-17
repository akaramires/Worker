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
     * @property integer        $id
     * @property string         $date
     * @property string         $deleted_at
     * @property \Carbon\Carbon $created_at
     * @property \Carbon\Carbon $updated_at
     * @method static \Illuminate\Database\Query\Builder|\Holidays whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\Holidays whereDate($value)
     * @method static \Illuminate\Database\Query\Builder|\Holidays whereDeletedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\Holidays whereCreatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\Holidays whereUpdatedAt($value)
     */
    class Holidays extends Eloquent
    {
        use SoftDeletingTrait;

        protected $table = 'holidays';

        public static $rules = array(
            'date' => 'required|date',
        );
    }