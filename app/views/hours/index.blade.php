{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('page_actions')
    <div class="col-sm-5">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge">{{ DateHelper::workDays(); }}</span> Total days:
            </li>
            <li class="list-group-item">
                <span class="badge">{{ DateHelper::workHours(); }}</span> Total hours:
            </li>
        </ul>
    </div>
    <div class="col-sm-5">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge"> {{ $hours_worked; }}</span> Worked hours:
            </li>
            <li class="list-group-item">
                <span class="badge"> {{ $hours_unreported; }}</span> Unreported hours:
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h4 class="panel-title text-right"><i class="fa fa-plus"></i> Add hours</h4>
                        </a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            {{ Form::open( array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => 'form-add-hours'
                                ) ) }}
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-md-2 control-label">Date</label>
                                        <div class="col-xs-4 col-md-4">
                                            {{ Form::text( 'hours_date', '', array(
                                                'id' => 'hours_date',
                                                'class' => 'form-control',
                                                'required' => true,
                                                'data-date-format' => 'YYYY-MM-DD',
                                            ) ) }}
                                            <p class="help-block text-right"></p>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <button class="btn btn-success" type="button" onclick="$('#hours_date').val('<?php echo date('Y-m-d'); ?>')">Today</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Project</label>
                                        <div class="col-sm-10">
                                            {{ Form::select('hours_project', array(null=>'Please Select') + $projects, '', array(
                                                'id' => 'hours_project',
                                                'class' => 'form-control project-dropdown',
                                                'data-destination' => ($taskSelect = uniqid()),
                                                'required' => true,
                                            ) ); }}
                                            <p class="help-block text-right"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Task</label>
                                        <div class="col-sm-10">
                                            {{ Form::select('hours_task', array(null=>'Please Select'), '', array(
                                                'id' => 'hours_task',
                                                'class' => 'form-control task-dropdown-' . $taskSelect,
                                                'required' => true,
                                                'disabled' => 'disabled'
                                            ) ); }}
                                            <p class="help-block text-right"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Hours</label>
                                        <div class="col-sm-10">
                                            {{ Form::number( 'hours_count', '', array(
                                                'id' => 'hours_count',
                                                'class' => 'form-control',
                                                'required' => true,
                                            ) ) }}
                                            <p class="help-block text-right"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            {{ Form::textarea( 'hours_description', '', array(
                                                'id' => 'hours_description',
                                                'class' => 'form-control',
                                                'required' => true,
                                                'rows' => 3,
                                            ) ) }}
                                            <p class="help-block text-right"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-9">
                                            <p class="text-right text-danger form-error"></p>
                                        </div>
                                        <div class="col-sm-3">
                                            {{ Form::submit('Save', array(
                                                'id' => 'hours_save',
                                                'class' => 'btn btn-success btn-block',
                                            ) )}}
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
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
                    <div class="col-sm-4">
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
                    <div class="col-sm-6">
                        <ul class="list-inline">
                            <li>
                                {{ Form::select('filter[project]', array(null => 'Please Select') + $projects, '', array(
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
                        {{ Form::button('Search', array(
                            'id' => 'filter_run',
                            'class' => 'btn btn-info btn-sm',
                        ) )}}
                        {{ HTML::link('/', 'Clear', array('class' => 'btn btn-default btn-sm') ) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>

        <table class="table table-condensed table-hover table-bordered table-hours">
            <thead>
                <tr>
                    <th class="text-center col-date">Date</th>
                    <th class="text-center col-hours">Hours</th>
                    <th class="text-center col-project" colspan="2">Project</th>
                    <th>Description</th>
                    <th class="col-operations"></th>
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
                        <td class="text-center">
                            <a class="btn btn-warning btn-sm btn-edit-hours pull-left" href="{{ route('hours.edit', $hour->id) }}">Edit</a>
                            {{ Form::open(array('url' => '/' . $hour->id, 'class' => 'form-delete-hours')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::hidden('redirect', $_SERVER['REQUEST_URI']) }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-sm pull-right')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td class="text-center">{{ $hours_sum }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        @if($hours->getLastPage() > 1)
            <div class="text-center panel-body">
                {{ $hours->appends(Input::except('page'))->links(); }}
            </div>
        @endif

    </div>
@stop
