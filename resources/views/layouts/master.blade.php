@include('layouts.partials.head')

<body>
    @yield('content')

    <script>
        var BASE_URL = '{!! url('/') !!}'
    </script>

    <script src="/js/app.js" async></script>
    @yield('js')
</body>
</html>