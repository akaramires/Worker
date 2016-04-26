<?php

class ReportClientsController extends BaseController
{
    public function index()
    {
        $searchFrom = date('Y-m-01');
        $searchTo = date('Y-m-t');

        $users = array();

        $projects = Project::where('parent_id', '=', 0)->where('client_id', '=', Auth::id())->orderBy('title')->lists('title', 'id');

        if(empty($projects)){
            $oneProject=Project::whereIn('parent_id', array(''))->lists('id');
        } else{
            $oneProject=Project::whereIn('parent_id', array_keys($projects))->lists('id');
        }

        $hours = Hour::whereIn('project_id',$oneProject)->orderBy('date', 'desc');

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

        $hours = $hours->where('date', 'BETWEEN', DB::raw("'$searchFrom' AND '$searchTo'"));
        $hours_sum = $hours->sum('count');
        $hours_rows = $hours->paginate(10);

        foreach ($hours_rows as &$hour) {
            if ($hour->project->parent_id == 0) {
                $hour->project_parent = $hour->project->title;
            } else {
                $hour->project_parent = Project::find($hour->project->parent_id)->title;
                $hour->project_child = $hour->project->title;
            }
        }

        return View::make('reports.index')
            ->with('page_title', date('F'))
            ->with('projectsList', $projects)
            ->with('usersList', $users)
            ->with('hours', $hours_rows)
            ->with('hours_sum', $hours_sum);
    }

}
