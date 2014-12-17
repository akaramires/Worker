<?php

    /**
     * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
     *
     * @copyright (C)Copyright 2014 eatech.org
     *               Date: 12/13/14
     *               Time: 12:36 AM
     */
    class ProjectsTableSeeder extends Seeder
    {
        private $projects;
        private $projectsRelations;

        public function run()
        {
            $wp_terms = app_path() . '/database/seeds/wp_terms.php';
            $wp_term_taxonomy = app_path() . '/database/seeds/wp_term_taxonomy.php';

            if (!file_exists($wp_terms) || !file_exists($wp_term_taxonomy)) {
                return false;
            }

            DB::table('projects')->delete();

            $this->projects = require($wp_terms);
            $this->projectsRelations = require($wp_term_taxonomy);

            $prs = array();
            foreach ($this->projectsRelations as $projectsRelation) {
                if ($projectsRelation['taxonomy'] == 'category') {
                    if (!$projectsRelation['parent']) {
                        $prs[$projectsRelation['term_id']] = array();
                    }
                }
            }

            foreach ($this->projectsRelations as $projectsRelation) {
                if ($projectsRelation['parent'] && array_key_exists($projectsRelation['parent'], $prs)) {
                    $prs[$projectsRelation['parent']]['child'][$projectsRelation['term_id']] = array();
                }
            }

            foreach ($prs as $parent_id => &$parent) {
                $parent = array_merge($this->getTerm($parent_id), $parent);

                $parentModel = new Project();
                $parentModel->parent_id = 0;
                $parentModel->title = $parent['title'];
                $parentModel->slug = $parent['slug'];
                $parentModel->save();

                if (sizeof($parent['child'])) {
                    foreach ($parent['child'] as $child_id => &$child) {
                        $child = array_merge($this->getTerm($child_id), $child);

                        $childModel = new Project();
                        $childModel->parent_id = $parentModel->id;
                        $childModel->title = $child['title'];
                        $childModel->slug = $child['slug'];
                        $childModel->save();
                    }
                }
            }

            $myParentModel = new Project();
            $myParentModel->parent_id = 0;
            $myParentModel->title = 'Main project';
            $myParentModel->slug = 'main-project';
            $myParentModel->save();

            $myChildModel = new Project();
            $myChildModel->parent_id = $myParentModel->id;
            $myChildModel->title = 'Android App';
            $myChildModel->slug = 'android-app';
            $myChildModel->save();

            $myChildModel = new Project();
            $myChildModel->parent_id = $myParentModel->id;
            $myChildModel->title = 'Website';
            $myChildModel->slug = 'website';
            $myChildModel->save();

        }

        private function getTerm($id)
        {
            foreach ($this->projects as $project) {
                if ($project['term_id'] == $id) {
                    return array(
                        'title' => $project['name'],
                        'slug'  => $project['slug'],
                    );
                }
            }

            return false;
        }
    }
