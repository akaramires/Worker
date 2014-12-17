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

            {{ Form::open(array('url' => route('users.index'), 'class' => 'form-horizontal')) }}

                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                    {{ Form::label('username', 'Username', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    {{ Form::label('password', 'Password', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    {{ Form::label('password_confirmation', 'Confirm', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
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
