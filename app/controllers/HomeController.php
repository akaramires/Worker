<?php

class HomeController extends BaseController
{

    public function index ()
    {
        $hours = Auth::user()->hours()->take(10)->get();

        foreach ($hours as &$hour) {
            if ($hour->project->parent_id == 0) {
                $hour->project_parent = $hour->project->title;
            } else {
                $hour->project_parent = Project::find($hour->project->parent_id)->title;
                $hour->project_child  = $hour->project->title;
            }
        }

        $projects = Project::where('parent_id' , '=', 0)->orderBy('title')->get();

        return View::make('developer/index', array('projects' => $projects, 'hours' => $hours));
    }

}
