<?php

    class ReportController extends BaseController
    {
        public function index ()
        {
            $searchFrom = date('Y-m-01');
            $searchTo   = date('Y-m-t');

            $users    = Role::find(3)->users()->orderBy('last_name')->lists('last_name', 'id');
            $projects = Project::where('parent_id', '=', 0)->orderBy('title')->lists('title', 'id');
            $hours    = Hour::orderBy('date', 'desc');

            if (Input::get('from') != null) {
                $searchFrom = date('Y-m-d', Input::get('from'));
            }

            if (Input::get('to') != null) {
                $searchTo = date('Y-m-d', Input::get('to'));
            }

            if (Input::get('task') != null) {
                $hours = $hours->where('project_id', '=', Input::get('task'));
            }

            if (Input::get('dev') != null) {
                $hours = $hours->where('user_id', '=', Input::get('dev'));
            }

            $hours = $hours->where('date', 'BETWEEN', DB::raw("'$searchFrom' AND '$searchTo'"))->paginate(10);

            foreach ($hours as &$hour) {
                if ($hour->project->parent_id == 0) {
                    $hour->project_parent = $hour->project->title;
                } else {
                    $hour->project_parent = Project::find($hour->project->parent_id)->title;
                    $hour->project_child  = $hour->project->title;
                }
            }

            return View::make('reports.index')
                ->with('page_title', 'Reports')
                ->with('projectsList', $projects)
                ->with('usersList', $users)
                ->with('hours', $hours);
        }

    }
