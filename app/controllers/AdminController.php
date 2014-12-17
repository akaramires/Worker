<?php

    class AdminController extends BaseController
    {
        public function index ()
        {
            $holidays = Holiday::orderBy('date', 'desc')->get();

            return View::make('admin.index')
                ->with('page_title', 'General settings')
                ->with('holidays', $holidays);
        }

        public function store ()
        {
            $validator = Validator::make(Input::all(), Holiday::$rules);

            if ($validator->fails()) {
                return Redirect::route('admin.index')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $holiday       = new Holiday;
                $holiday->date = Input::get('date');
                $holiday->save();

                Session::flash('successMsg', 'Successfully added holiday!');

                return Redirect::route('admin.index');
            }
        }
    }
