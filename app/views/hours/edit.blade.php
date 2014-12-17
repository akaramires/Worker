{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('content')
    <div class="row">
        {{ HTML::ul($errors->all(), array('class' => 'alert alert-danger hide')) }}

        {{ Form::model($hour, array(
            'route' => array('hours.update', $hour->id),
            'method' => 'PUT',
            'class' => 'form-horizontal form-edit'
        )) }}
            {{ Form::hidden('projectDDownId', $hour->project->parent_id); }}
            {{ Form::hidden('taskDDownId', $hour->project_id); }}

            <div class="col-sm-4">
                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                    {{ Form::label('date', 'Date', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text( 'date', null, array(
                            'class' => 'form-control js-its-datepicker',
                            'required' => true,
                            'data-date-format' => 'YYYY-MM-DD',
                        )) }}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('project') ? 'has-error' : '' }}">
                    {{ Form::label('project', 'Project', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::select('project', array(null => 'Please Select') + $projects, '', array(
                            'class' => 'form-control project-dropdown',
                            'data-destination' => ($taskSelect = uniqid()),
                            'required' => true,
                        )); }}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('task') ? 'has-error' : '' }}">
                    {{ Form::label('task', 'Task', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::select('task', array(null=>'Please Select'), '', array(
                            'class' => 'form-control task-dropdown-' . $taskSelect,
                            'required' => true,
                            'disabled' => 'disabled'
                        )); }}
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="form-group {{ $errors->has('count') ? 'has-error' : '' }}">
                    {{ Form::label('count', 'Hours count', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-2">
                        {{ Form::number( 'count', null, array(
                            'class' => 'form-control',
                            'required' => true,
                        )) }}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {{ Form::label('description', 'Description', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::textarea( 'description', null, array(
                            'class' => 'form-control',
                            'required' => true,
                            'rows' => 5,
                        )) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
            </div>
        {{ Form::close() }}
    </div>
@stop
