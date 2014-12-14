{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('content')
    <div class="row">
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
                            'class' => 'form-control',
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
                            'class' => 'form-control',
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
                            'id' => 'hours_description',
                            'class' => 'btn btn-success btn-block',
                            'required' => true,
                            'rows' => 3,
                        ) )}}
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        {{ Form::close() }}
    </div>

    <div class="hr"></div>

    <div class="panel panel-default panel-hours">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-inline filter-row">
                        <li>
                            <div class="input-group input-group-sm">
                              <input type="text" name="hours-date-from" class="form-control date-input" placeholder="Date from">
                              <input type="text" name="hours-date-to" class="form-control date-input" placeholder="Date to">
                            </div>
                        </li>
                        <li>
                            <select name="project" class="form-control input-sm">
                                <option value="0" selected>Not selected</option>
                            </select>
                        </li>
                        <li>
                            <select name="task" class="form-control input-sm" disabled>
                                <option value="0" selected>Not selected</option>
                            </select>
                        </li>
                        <li>
                            <button type="button" class="btn btn-info btn-sm" disabled>Apply</button>
                        </li>
                    </ul>
                </div>
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
                            <button data-hours-id="{{$hour->id}}" type="button" class="btn btn-warning btn-sm btn-edit-hours pull-left">Edit</button>
                            {{ Form::open(array('url' => '/' . $hour->id, 'class' => 'form-delete-hours')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-sm pull-right')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center panel-body">
            {{ $hours->links() }}
        </div>

    </div>
@stop
