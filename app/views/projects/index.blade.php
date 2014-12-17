{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-10">
            {{ HTML::link(route('projects.create'), 'Add project', array('class' => 'btn btn-success btn-block btn-sm')); }}
        </div>
    </div>

    <div class="hr"></div>

    <div class="row">
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

                    <?php $index++;  ?>
                @endforeach
            </div>
        </div>
    </div>
@stop
