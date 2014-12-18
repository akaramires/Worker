<?php

    /**
     * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
     *
     * @copyright (C)Copyright 2014 eatech.org
     *               Date: 12/13/14
     *               Time: 12:36 AM
     */
    class HolidaysTableSeeder extends Seeder
    {
        public function run()
        {
            DB::table('holidays')->delete();

            Holiday::create(array('date' => '2014-10-31'));
            Holiday::create(array('date' => '2014-11-01'));
            Holiday::create(array('date' => '2014-12-31'));
            Holiday::create(array('date' => '2015-01-01'));
            Holiday::create(array('date' => '2015-02-28'));
            Holiday::create(array('date' => '2015-03-01'));
        }
    }
