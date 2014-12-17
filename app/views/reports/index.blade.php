{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12 text-center">
            <h4>{{date('F')}}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">{{ DateHelper::workDays(); }}</span>
                    Total days:
                </li>
            </ul>
        </div>
        <div class="col-sm-6">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">{{ DateHelper::workHours(); }}</span>
                    Total hours:
                </li>
            </ul>
        </div>
    </div>

    <div class="hr"></div>

    <div class="panel panel-default panel-hours">
        <div class="panel-body">
            <div class="row">
                {{ Form::open( array(
                    'class' => 'filter-row',
                    'method' => 'GET',
                    'id' => 'form-filter-hours',
                ) ) }}
                    {{ Form::hidden('projectDDownId', Input::get('project') ? Input::get('project') : '')}}
                    {{ Form::hidden('taskDDownId', Input::get('task') ? Input::get('task') : '')}}
                    <div class="col-sm-3">
                        <div class="input-group input-group-sm">
                            {{ Form::text( 'filter[from]', Input::get('from') ? date('Y-m-d', Input::get('from')) : '', array(
                                'id' => 'filter-date-from',
                                'class' => 'form-control date-input',
                                'required' => true,
                                'data-date-format' => 'YYYY-MM-DD',
                                'placeholder' => 'Date from'
                            ) ) }}
                            {{ Form::text( 'filter[to]', Input::get('to') ? date('Y-m-d', Input::get('to')) : '', array(
                                'id' => 'filter-date-to',
                                'class' => 'form-control date-input',
                                'required' => true,
                                'data-date-format' => 'YYYY-MM-DD',
                                'placeholder' => 'Date to'
                            ) ) }}
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <ul class="list-inline">
                            <li>
                                {{ Form::select('filter[project]', array(null=>'Please Select') + $projectsList, '', array(
                                    'id' => 'filter-project',
                                    'class' => 'form-control input-sm project-dropdown',
                                    'data-destination' => ($taskSelect = uniqid()),
                                    'required' => true,
                                ) ); }}
                            </li>
                            <li>
                                {{ Form::select('filter[task]', array(), '', array(
                                    'id' => 'filter-task',
                                    'class' => 'form-control input-sm task-dropdown-' . $taskSelect,
                                    'required' => true,
                                    'disabled' => 'disabled'
                                ) ); }}
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-2 text-right">
                        {{ Form::select('filter[dev]', array(null=>'Please Select') + $usersList, Input::get('dev') ? Input::get('dev') : '', array(
                            'id' => 'filter-dev',
                            'class' => 'form-control input-sm',
                            'required' => true,
                        ) ); }}
                    </div>
                    <div class="col-sm-2 text-right">
                        {{ Form::button('Search', array(
                            'id' => 'filter_run',
                            'class' => 'btn btn-info btn-sm',
                        ) )}}
                        {{ HTML::link('/', 'Clear', array('class' => 'btn btn-default btn-sm') ) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>

        @if(!empty($hours))
            <table class="table table-condensed table-hover table-bordered table-hours">
                <thead>
                    <tr>
                        <th class="text-center col-date">Date</th>
                        <th class="text-center col-hours">Hours</th>
                        <th class="text-center col-project" colspan="2">Project</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hours as $hour)
                        <tr>
                            <td class="text-center">{{$hour->date}}</td>
                            <td class="text-center">{{$hour->count}}</td>
                            <td class="col-project">{{$hour->project_parent}}</td>
                            <td class="col-project">{{$hour->project_child}}</td>
                            <td>{{ $hour->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($hours->getLastPage() > 1)
                <div class="text-center panel-body">
                    {{ $hours->links() }}
                </div>
            @endif
        @endif

    </div>
@stop
