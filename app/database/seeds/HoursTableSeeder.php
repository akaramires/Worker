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

            $wp = '/var/www/wordpress/public_html/wp-blog-header.php';

            if (file_exists($wp)) {
                define('WP_USE_THEMES', false);
                require('/var/www/wordpress/public_html/wp-blog-header.php');

                $projects = Project::where('parent_id', '!=', 0)->get();

                foreach ($projects as $project) {
                    $query = new WP_Query('cat=' . $project->wp_id . '&orderby=ID&order=ASC&posts_per_page=-1');

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            $data = array(
                                'wp_id'       => get_the_ID(),
                                'user_id'     => User::where('wp_id', '=', get_post_field('post_author', get_the_ID()))->first()->id,
                                'project_id'  => $project->id,
                                'description' => get_the_content(),
                                'count'       => get_post_meta(get_the_ID(), 'hours', true),
                                'date'        => (new DateTime(get_post_meta(get_the_ID(), 'date', true)))->format('Y-m-d'),
                                'created_at'  => (new DateTime(get_the_date()))->format('Y-m-d H:i:s'),
                                'updated_at'  => (new DateTime(get_the_date()))->format('Y-m-d H:i:s'),
                            );


                            Hour::create($data);
                        endwhile;
                    endif;
                    wp_reset_query();
                }
            }
        }
    }
