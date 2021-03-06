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
        {{ HTML::style('bower/fontawesome/css/font-awesome.min.css')}}
        {{ HTML::style('bower/animate/animate.min.css')}}
        {{ HTML::style('css/styles.css')}}

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-45540097-10', 'auto');
          ga('send', 'pageview');

        </script>
    </head>

    <body>

        @yield('header')

        <div class="container">
            @include('partials.flash')

            @if (!empty($page_title))
                <div class="row">
                    <div class="col-sm-2">
                        <h4>{{ $page_title; }}</h4>
                    </div>
                    @yield('page_actions')
                </div>

                <div class="hr"></div>
            @endif

            @yield('content')
        </div>

        @yield('footer')

        {{ HTML::script('bower/jquery/dist/jquery.min.js') }}
        {{ HTML::script('bower/bootstrap/dist/js/bootstrap.min.js') }}
        {{ HTML::script('bower/moment/min/moment.min.js') }}
        {{ HTML::script('bower/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}
        {{ HTML::script('bower/noty/js/noty/packaged/jquery.noty.packaged.min.js') }}
        {{ HTML::script('js/main.js') }}
        @if(Auth::check())
            {{ HTML::script('js/' . Auth::user()->role->slug . '.js') }}
        @endif
        @yield('scripts')
    </body>
</html>
