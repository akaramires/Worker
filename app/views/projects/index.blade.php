{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            {{ HTML::link(route('projects.create'), 'Add project', array('class' => 'btn btn-success btn-block btn-sm')); }}
        </div>
        <div class="col-sm-6">
        </div>
    </div>

    <div class="hr"></div>

    <div class="panel-group" id="accordion" role="tablist">
        @foreach ($projects as $project)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading{{$project->id}}">
                    <h4 class="panel-title">
                        <a class="small" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$project->id}}" aria-expanded="true" aria-controls="collapse{{$project->id}}">
                            {{$project->title}}
                        </a>
                        <a class="small pull-right" href="{{ route('projects.edit', array('id' => $project->id)) }}">Edit</a>
                    </h4>
                </div>
                <div id="collapse{{$project->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$project->id}}">
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            @foreach ($project->projects() as $sub)
                                <li>{{$sub->title}} <a class="small pull-right" href="{{ route('projects.edit', array('id' => $sub->id)) }}">Edit</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($projects->getLastPage() > 1)
        <div class="text-center panel-body">
            {{ $projects->links() }}
        </div>
    @endif
@stop
