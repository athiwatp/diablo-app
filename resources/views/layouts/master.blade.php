@include('layouts.partials.head')

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