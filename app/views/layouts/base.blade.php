{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 5:53 PM
--}}


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Elmar Abdurayimov">

        <title>Track Your Time</title>

        {{ HTML::style('bower/bootstrap-flat/index.css') }}
        {{ HTML::style('bower/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}
        {{ HTML::style('bower/animate/animate.min.css')}}
        {{ HTML::style('css/styles.css')}}
    </head>

    <body>

        @yield('header')

        <div class="container">
            @include('partials.flash')

            @yield('content')
        </div>

        @yield('footer')

        {{ HTML::script('bower/jquery/dist/jquery.min.js') }}
        {{ HTML::script('bower/bootstrap/dist/js/bootstrap.min.js') }}
        {{ HTML::script('bower/moment/min/moment.min.js') }}
        {{ HTML::script('bower/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}
        {{ HTML::script('bower/noty/js/noty/packaged/jquery.noty.packaged.min.js') }}
        {{ HTML::script('js/main.js') }}
    </body>
</html>
