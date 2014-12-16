<?php


    class HomeController extends BaseController
    {

        public function index()
        {
            /** @var \Hour $hours */
            $hours = Auth::user()->hours();

            if (Input::get('from') != null) {
                $searchFrom = date('Y-m-d', Input::get('from'));
            } else {
                $searchFrom = date('Y-m-01');
            }

            if (Input::get('to') != null) {
                $searchTo = date('Y-m-d', Input::get('to'));
            } else {
                $searchTo = date('Y-m-t');
            }

            $hours = $hours->where('date', 'BETWEEN', DB::raw("'$searchFrom' AND '$searchTo'"));

            if (Input::get('project') != null) {
                $hours = $hours->where('project_id', '=', Input::get('project'));
            }

            if (Request::ajax()) {
            } else {

                $hours = $hours->orderBy('date', 'desc')->paginate(10);

                foreach ($hours as &$hour) {
                    if ($hour->project->parent_id == 0) {
                        $hour->project_parent = $hour->project->title;
                    } else {
                        $hour->project_parent = Project::find($hour->project->parent_id)->title;
                        $hour->project_child = $hour->project->title;
                    }
                }

                $projects = Project::where('parent_id', '=', 0)->orderBy('title')->lists('title', 'id');

                $hoursInCurMonth = Auth::user()->hours()->where('date', 'BETWEEN', DB::raw("'" . date('Y-m-01') . "' AND '" . date('Y-m-t') . "'"))->sum('count');

                return View::make('developer/hours')
                    ->with('page_title', 'Your hours')
                    ->with('projects', $projects)
                    ->with('hours', $hours)
                    ->with('hours_worked', $hoursInCurMonth)
                    ->with('hours_unreported', (DateHelper::workHours() - $hoursInCurMonth));
            }
        }

        public function store()
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

            $model = new Hour;
            $model->user_id = Auth::user()->id;
            $model->date = $data['hours_date'];
            $model->project_id = $data['hours_task'];
            $model->description = $data['hours_description'];
            $model->count = $data['hours_count'];

            if ($model->save()) {
                Session::flash('successMsg', 'Hours created successfully');

                return Response::json(array(
                    'success' => true,
                    'id'      => $model->id,
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

        public function destroy($id)
        {
            $hours = Auth::user()->hours()->find($id);
            if (!$hours) {
                return Redirect::to('/')->with('errorMsg', 'You don\'t have permission to access the requested page');

            }

            $hours->delete();

            return Redirect::to(Input::get('redirect'))->with('successMsg', 'The entity was deleted successfully.');
        }

        public function tasks()
        {
            $projects = Project::where('parent_id', '=', Input::get('option'))->orderBy('title')->lists('title', 'id');

            return Response::json($projects);
        }

    }
