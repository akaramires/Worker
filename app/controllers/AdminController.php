<?php

    class AdminController extends BaseController
    {
        public function index()
        {
            $prev_month = date_create(date('Y-m-d') . ' first day of last month');
            $prev_month_name = $prev_month->format('F');
            $prev_month_start = $prev_month->format('Y-m-01');
            $prev_month_end = $prev_month->format('Y-m-t');

            $cur_month_name = date('F');
            $cur_month_start = date('Y-m-01');
            $cur_month_end = date('Y-m-t');

            $next_month = date_create(date('Y-m-d') . ' +1 month');
            $next_month_name = $next_month->format('F');
            $next_month_start = $next_month->format('Y-m-01');
            $next_month_end = $next_month->format('Y-m-t');

            $holidays = array();

            $next_month_rows = Holiday::orderBy('date', 'desc')->where('date', 'BETWEEN', DB::raw("'$next_month_start' AND '$next_month_end'"))->get();
            if (sizeof($next_month_rows)) {
                $holidays[$next_month_name] = $next_month_rows;
            }

            $cur_month_rows = Holiday::orderBy('date', 'desc')->where('date', 'BETWEEN', DB::raw("'$cur_month_start' AND '$cur_month_end'"))->get();
            if (sizeof($cur_month_rows)) {
                $holidays[$cur_month_name] = $cur_month_rows;
            }

            $prev_month_rows = Holiday::orderBy('date', 'desc')->where('date', 'BETWEEN', DB::raw("'$prev_month_start' AND '$prev_month_end'"))->get();
            if (sizeof($prev_month_rows)) {
                $holidays[$prev_month_name] = $prev_month_rows;
            }

            return View::make('admin.index')
                ->with('page_title', 'General settings')
                ->with('holidays', $holidays);
        }

        public function store()
        {
            $validator = Validator::make(Input::all(), Holiday::$rules);

            if ($validator->fails()) {
                return Redirect::route('admin.index')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $holiday = new Holiday;
                $holiday->date = Input::get('date');
                $holiday->save();

                Session::flash('successMsg', 'Successfully added holiday!');

                return Redirect::route('admin.index');
            }
        }

        public function destroy($id)
        {
            if (Input::get('delete') != null && Input::get('delete') == 'holiday') {
                $holiday = Holiday::find($id);
                if ($holiday) {
                    $holiday->delete();

                    Session::flash('successMsg', 'Successfully deleted the holiday!');
                    return Redirect::route('admin.index');
                }

                Session::flash('errorMsg', 'You do not have access to delete this holiday.');
            }

            return Redirect::route('admin.index');
        }
    }
