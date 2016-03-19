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
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-75262397-1', 'auto');
            ga('send', 'pageview');
        </script>
    @endif
</body>
</html>