{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            {{ HTML::ul($errors->all(), array('class' => 'alert alert-danger hide')) }}

            {{ Form::model($project, array('route' => array('projects.update', $project->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

                <div class="form-group">
                    {{ Form::label('parent', 'Parent', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::label('parent', $parent ? $parent->title : 'No parent', array('class' => 'form-control', 'disabled' => 'disabled')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('title', 'Title', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('title', null, array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>

            {{ Form::close() }}
        </div>
    </div>
@stop
