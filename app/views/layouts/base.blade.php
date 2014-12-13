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

        {{ HTML::style('packages/bootstrap/css/bootstrap-flat.min.css') }}
        {{ HTML::style('css/styles.css')}}
    </head>

    <body>

        @yield('header')

        <div class="container">
            @include('partials.flash')

            @yield('content')
        </div>

        @yield('footer')

        <script src="/js/jquery-1.11.1.min.js"></script>
        <script src="/packages/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
