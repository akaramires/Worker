{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 6:44 PM
--}}

@if(Session::has('errorMsg'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('errorMsg') }}
    </div>
@endif

@if(Session::has('successMsg'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('successMsg') }}
    </div>
@endif

@if(Session::has('warningMsg'))
    <div class="alert alert-warning" role="alert">
        {{ Session::get('warningMsg') }}
    </div>
@endif
