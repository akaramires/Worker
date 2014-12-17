<?php

    class ProjectController extends BaseController
    {
        public function index()
        {
            $projects = Project::where('parent_id', '=', 0)->orderBy('title')->paginate(20);

            return View::make('projects.index')
                ->with('page_title', 'Projects')
                ->with('projects', $projects);
        }

        public function create()
        {

        }

        public function edit()
        {

        }

        public function store()
        {

        }
    }
