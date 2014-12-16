<?php

    class ReportController extends BaseController
    {
        public function index()
        {
            echo '<pre>';
            var_dump(Permission::find(3));
            echo '</pre>';
            die;
            $usersList = Permission::orderBy('last_name')->lists('last_name', 'id');
            $projectsList = Project::where('parent_id', '=', 0)->orderBy('title')->lists('title', 'id');

            return View::make('manager/index')
                ->with('page_title', 'Reports')
                ->with('projectsList', $projectsList)
                ->with('usersList', $usersList);
        }

    }
