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

            {{ Form::model($project, array('route' => array('projects.update', $project->id), 'method' => 'PUT')) }}

                <div class="form-group">
                    {{ Form::label('parent', 'Parent') }}
                    {{ Form::label('parent', $parent ? $parent->title : 'No parent', array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, array('class' => 'form-control')) }}
                </div>

                {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>
@stop
