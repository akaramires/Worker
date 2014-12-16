<?php

    /**
     * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
     *
     * @copyright (C)Copyright 2014 e.abdurayimov@gmail.com
     *               Date: 12/16/14
     *               Time: 11:51 AM
     */

    /**
     * Class DateHelper
     */
    class DateHelper
    {
        const HOURS_IN_DAY = 8;

        public static function workDays()
        {
            $dt = new DateTime('now');
            for ($d = $days = 0; $d < $dt->format('t'); $d++, $dt->modify('next day')) {
                $days += $dt->format('N') < 6 ? 1 : 0;
            }
            return $days;
        }

        public static function workHours()
        {
            return self::workDays() * self::HOURS_IN_DAY;
        }
    }