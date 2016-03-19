<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Diablo Rankings</title>
    <meta name="description" content="Diablo Rankings">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <link rel="icon" type="image/png" href="/img/diablorankings-fav.png">
</head>

<body>
    @yield('content')

    <script>
        var BASE_URL = '{!! url('/') !!}'
        var CURRENT_SEASON = '{{ env('CURRENT_SEASON', 5) }}'
    </script>

    <script src="{{ elixir('js/app.js') }}"></script>
    @yield('js')

    @if (env('APP_ENV') == 'production')
        <script>
            !function(d,i,a,b,l,o){d.GoogleAnalyticsObject=a;d[a]||(d[a]=function(){
                (d[a].q=d[a].q||[]).push(arguments)});d[a].l=+new Date;l=i.createElement(b);
                o=i.getElementsByTagName(b)[0];l.src='//www.google-analytics.com/analytics.js';
                o.parentNode.insertBefore(l,o)}(window,document,'ga','script');
            ga('create', 'UA-75262397-1', 'auto');
            ga('send', 'pageview');
        </script>
    @endif
</body>
</html>