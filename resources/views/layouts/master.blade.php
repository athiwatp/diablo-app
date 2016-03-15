<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Diablo Rankings</title>
    <meta name="description" content="Diablo Rankings">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/app.css">
    <link rel="icon" type="image/png" href="/img/diablorankings-fav.png">
</head>

<body>
    @yield('content')

    <script>
        var BASE_URL = '{!! url('/') !!}'
        var CURRENT_SEASON = '{{ env('CURRENT_SEASON', 5) }}'
    </script>

    <script src="/js/app.js"></script>
    @yield('js')
</body>
</html>