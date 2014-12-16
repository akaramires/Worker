<?php

    class ReportController extends BaseController
    {
        public function index ()
        {
            $users    = Role::find(3)->users()->orderBy('last_name')->lists('last_name', 'id');
            $projects = Project::where('parent_id', '=', 0)->orderBy('title')->lists('title', 'id');

            return View::make('manager/index')
                ->with('page_title', 'Reports')
                ->with('projectsList', $projects)
                ->with('usersList', $users);
        }

    }
