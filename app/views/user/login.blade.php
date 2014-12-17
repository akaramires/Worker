{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 5:29 PM
--}}

@extends('layouts.main')

@section('content')
    {{ Form::open(array('url' => 'login', 'class' => 'form-horizontal', 'role' => 'form')) }}

        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
            <label class="col-sm-2 col-sm-offset-2 control-label">Username</label>
            <div class="col-sm-4">
                {{ Form::text('username', null, array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label class="col-sm-2 col-sm-offset-2 control-label">Password</label>
            <div class="col-sm-4">
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                {{ Form::submit('Login', array('class' => 'btn btn-default')) }}
            </div>
        </div>

    {{ Form::close() }}
@stop
