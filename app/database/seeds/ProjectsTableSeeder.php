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

        public function run ()
        {
            DB::table('projects')->delete();

            $this->projects          = DB::table('wp_terms')->get();
            $this->projectsRelations = DB::table('wp_term_taxonomy')->get();

            $prs = array();
            foreach ($this->projectsRelations as $projectsRelation) {
                if ($projectsRelation->taxonomy == 'category') {
                    if (!$projectsRelation->parent) {
                        $prs[$projectsRelation->term_id] = array();
                    }
                }
            }

            foreach ($this->projectsRelations as $projectsRelation) {
                if ($projectsRelation->parent && array_key_exists($projectsRelation->parent, $prs)) {
                    $prs[$projectsRelation->parent]['child'][$projectsRelation->term_id] = array();
                }
            }

            foreach ($prs as $parent_id => &$parent) {
                $parent = array_merge($this->getTerm($parent_id), $parent);

                $parentModel            = new Project();
                $parentModel->wp_id     = $parent_id;
                $parentModel->parent_id = 0;
                $parentModel->title     = $parent['title'];
                $parentModel->slug      = $parent['slug'];
                $parentModel->save();

                if (sizeof($parent['child'])) {
                    foreach ($parent['child'] as $child_id => &$child) {
                        $child = array_merge($this->getTerm($child_id), $child);

                        $childModel            = new Project();
                        $childModel->wp_id     = $child_id;
                        $childModel->parent_id = $parentModel->id;
                        $childModel->title     = $child['title'];
                        $childModel->slug      = $child['slug'];
                        $childModel->save();
                    }
                }
            }
        }

        private function getTerm ($id)
        {
            foreach ($this->projects as $project) {
                if ($project->term_id == $id) {
                    return array(
                        'title' => $project->name,
                        'slug'  => $project->slug,
                    );
                }
            }

            return false;
        }
    }
