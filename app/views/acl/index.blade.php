{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 9:59 PM
--}}

@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-2">
            <h4>Developers</h4>
        </div>
        <div class="col-sm-2 col-sm-offset-8">
            {{ HTML::link(route('users.create'), 'Add user', array('class' => 'btn btn-success btn-block btn-sm')); }}
        </div>
    </div>

    <div class="hr"></div>

    <div class="row users-list">
        <div class="col-sm-12">
            <table class="table table-condensed table-hover table-bordered table-hours">
                    <thead>
                        <tr>
                            <th class="col-fname">First name</th>
                            <th class="col-lname">Last name</th>
                            <th class="col-lname">Username</th>
                            <th class="col-lname">Email</th>
                            <th class="col-operations"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="">{{$user->first_name}}</td>
                                <td class="">{{$user->last_name}}</td>
                                <td class="">{{$user->username}}</td>
                                <td class="">{{$user->email}}</td>
                                <td class="text-center">
                                    @if ($user->trashed())
                                        {{ Form::open(array('route' => array('users.destroy', $user->id, 'restore' => 1), 'method' => 'delete', 'class' => '')) }}
                                            <button type="submit" class="btn btn-danger btn-xs">Restore</button>
                                        {{ Form::close() }}
                                    @else
                                        <a class="btn btn-warning btn-xs" href="{{ route('users.edit', array('id' => $user->id)) }}">Edit</a>
                                        {{ Form::open(array('route' => array('users.destroy', $user->id), 'method' => 'delete', 'class' => '')) }}
                                            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                        {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@stop
