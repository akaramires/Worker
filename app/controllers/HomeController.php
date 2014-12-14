<?php

class HomeController extends BaseController
{

    public function index ()
    {
        if (Request::ajax()) {
        } else {

            $hours = Auth::user()->hours()->paginate(10);

            foreach ($hours as &$hour) {
                if ($hour->project->parent_id == 0) {
                    $hour->project_parent = $hour->project->title;
                } else {
                    $hour->project_parent = Project::find($hour->project->parent_id)->title;
                    $hour->project_child  = $hour->project->title;
                }
            }

            $projects = Project::where('parent_id', '=', 0)->orderBy('title')->lists('title', 'id');

            return View::make('developer/index', array('projects' => $projects, 'hours' => $hours));
        }
    }

    public function store ()
    {
        if (Session::token() !== Input::get('_token')) {
            return Response::json(array(
                'success' => false,
                'type'    => 'token',
                'msg'     => 'Unauthorized attempt to create hours',
            ));
        }

        $data = Input::all();

        $validator = Validator::make($data, Hour::$rules);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'type'    => 'validation',
                'errors'  => $validator->getMessageBag()->toArray()

            ), 200);
        }

        $model              = new Hour;
        $model->user_id     = Auth::user()->id;
        $model->date        = $data['hours_date'];
        $model->project_id  = $data['hours_task'];
        $model->description = $data['hours_description'];
        $model->count       = $data['hours_count'];

        if ($model->save()) {
            return Response::json(array(
                'success' => true,
                'msg'     => 'Hours created successfully',
            ), 200);
        } else {
            return Response::json(array(
                'success' => false,
                'type'    => 'save',
                'msg'     => 'Errors were encountered during the save process, please try again.',
            ), 200);
        }
    }

    public function tasks ()
    {
        $projects = Project::where('parent_id', '=', Input::get('option'))->orderBy('title')->lists('title', 'id');

        return Response::json($projects);
    }

}
