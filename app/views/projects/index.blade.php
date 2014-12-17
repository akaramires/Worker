{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('page_actions')
    <div class="col-sm-2 col-sm-offset-8">
        {{ HTML::link(route('projects.create'), 'Add project', array('class' => 'btn btn-success btn-block btn-sm')); }}
    </div>
@endsection

@section('content')
    <div class="row projects-list">
        <div class="col-sm-6">
            <div class="panel-group" id="accordion" role="tablist">
                <?php
                    $halfCount = ceil($projects->count()/2);
                    $index = 0;
                ?>
                @foreach ($projects as $project)
                    @if($index == $halfCount)
                        </div></div><div class="col-sm-6"><div class="panel-group" id="accordionRight" role="tablist">
                    @endif

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading{{$project->id}}">
                            <h4 class="panel-title">
                                <i class="fa fa-angle-down"></i>
                                <a class="small" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$project->id}}" aria-expanded="true" aria-controls="collapse{{$project->id}}">
                                   {{ $project->title }}
                                </a>
                                @if(!$project->hasHoursOrChilds())
                                    {{ Form::open(array('route' => array('projects.destroy', $project->id), 'method' => 'delete', 'class' => 'pull-right form-delete')) }}
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    {{ Form::close() }}
                                @else
                                    <a class="btn btn-danger btn-sm pull-right" disabled>Delete</a>
                                @endif
                                <a class="btn btn-warning btn-sm pull-right" href="{{ route('projects.edit', array('id' => $project->id)) }}">Edit</a>
                            </h4>
                        </div>
                        <div id="collapse{{$project->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$project->id}}">
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    @foreach ($project->projects() as $sub)
                                        <li>
                                            {{$sub->title}}
                                            @if(!$sub->hasHoursOrChilds())
                                                {{ Form::open(array('route' => array('projects.destroy', $sub->id), 'method' => 'delete', 'class' => 'pull-right form-delete')) }}
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                {{ Form::close() }}
                                            @else
                                                <a class="btn btn-danger btn-sm pull-right" disabled>Delete</a>
                                            @endif
                                            <a class="btn btn-warning btn-sm pull-right" href="{{ route('projects.edit', array('id' => $sub->id)) }}">Edit</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php $index++;  ?>
                @endforeach
            </div>
        </div>
    </div>
@stop
