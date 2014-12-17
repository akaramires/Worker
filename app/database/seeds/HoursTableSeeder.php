<?php

    /**
     * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
     *
     * @copyright (C)Copyright 2014 eatech.org
     *               Date: 12/13/14
     *               Time: 12:36 AM
     */
    class HoursTableSeeder extends Seeder
    {
        public function run()
        {
            DB::table('hours')->delete();

            $faker = Faker\Factory::create();

            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));

        }
    }
