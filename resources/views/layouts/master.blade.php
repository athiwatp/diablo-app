@include('layouts.partials.head')

<body>
    @yield('content')

    <script>
        var base_url = '{!! url('/') !!}'
    </script>

    <script src="/js/app.js"></script>
    @yield('js')
</body>
</html>