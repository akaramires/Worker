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
        public function run ()
        {
            DB::table('hours')->delete();

            $users = $users = Role::find(3)->users()->get();
            foreach ($users as $user) {
                $posts = DB::table('wp_posts')
                    ->where('post_status', '=', 'publish')
                    ->where('post_type', '=', 'post')
                    ->where('post_parent', '=', 0)
                    ->where('post_author', '=', $user->wp_id)
                    ->get();
            }
            
//            $faker = Faker\Factory::create();
//
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));
//            Hour::create(array('user_id' => 3, 'project_id' => rand(79, 80), 'description' => $faker->text, 'count' => rand(1, 8),
//                               'date'    => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d')));

        }
    }
