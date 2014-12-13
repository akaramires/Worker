{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('content')
    <div class="row">
        <form class="form-horizontal" role="form">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Date</label>
                    <div class="col-sm-10">
                        <input name="date" type="text" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Project</label>
                    <div class="col-sm-10">
                        <select name="project" class="form-control">
                            <option value="0" selected>Not selected</option>
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Task</label>
                    <div class="col-sm-10">
                        <select name="task" class="form-control" disabled>
                            <option value="0" selected>Not selected</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Hours</label>
                    <div class="col-sm-10">
                        <input name="hours" type="text" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" cols="30" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-9 col-sm-3">
                        <button type="button" class="btn btn-success btn-block"><span class="glyphicon glyphicon-plus"></span> Add</button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </form>
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
                                @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->title}}</option>
                                @endforeach
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
                {{--<div class="col-sm-2">--}}
                    {{--<button type="button" class="btn btn-block btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Add</button>--}}
                {{--</div>--}}
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
                        <td>
                            @if(strlen($hour->description) > 60)
                                {{ substr($hour->description, 0, 60) }}... <button class="btn btn-xs btn-link" data-toggle="modal" data-target="#moreDescription{{$hour->id}}"> more</button>
                                <div class="modal fade" id="moreDescription{{$hour->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">{{ $hour->description }}</div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{ $hour->description }}
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="...">
                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
