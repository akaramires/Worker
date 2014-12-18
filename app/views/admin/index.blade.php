{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/18/14
    Time: 1:07 AM
--}}
@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-offset-2 col-sm-4">
                    <h5>Add holiday</h5>
                </div>
            </div>
            {{ HTML::ul($errors->all(), array('class' => 'alert alert-danger hide')) }}

            {{ Form::open(array('url' => route('admin.index'), 'class' => 'form-horizontal')) }}

                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                    {{ Form::label('date', 'Date', array('class' => 'col-sm-2 control-label')) }}
                    <div class="col-sm-7">
                        {{ Form::text( 'date', null, array(
                            'class' => 'form-control js-its-datepicker js-its-datepicker-all',
                            'required' => true,
                            'data-date-format' => 'YYYY-MM-DD',
                        )) }}
                    </div>
                    <div class="col-sm-3">
                        {{ Form::submit('Save', array('class' => 'btn btn-primary btn-block')) }}
                    </div>
                </div>

            {{ Form::close() }}

            <ul class="list-grou">
                @foreach ($holidays as $month => $holiday)
                    <li class="list-group-item"><strong>{{ $month }}</strong></li>
                    @foreach ($holiday as $day)
                        <li class="list-group-item">
                            {{ $day->date }}
                            {{ Form::open(array('route' => array('admin.destroy', $day->id, 'delete' => 'holiday'), 'method' => 'delete', 'class' => 'pull-right form-delete')) }}
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
                            {{ Form::close() }}
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
@stop