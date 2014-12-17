{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/16/14
    Time: 12:25 AM
--}}

@extends('layouts.main')

@section('content')
    {{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}

        {{ HTML::ul($errors->all(), array('class' => 'alert alert-danger hide')) }}

        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label class="col-sm-2 col-sm-offset-2 control-label">Password</label>
            <div class="col-sm-4">
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <label class="col-sm-2 col-sm-offset-2 control-label">Confirm</label>
            <div class="col-sm-4">
                {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-2">
                {{ Form::submit('Change', array('class' => 'btn btn-warning btn-block')) }}
            </div>
        </div>

    {{ Form::close() }}
@stop
