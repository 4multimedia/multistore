<html lang="en" class="light">
    <head>
        <link rel="stylesheet" href="{{ mix('css/backend.css') }}" />
        {{ get_css() }}
        <title>Admin</title>
    </head>
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        <div id="app">
            <div>{!! do_menu() !!}</div>
            <div>
                @yield('content')
            </div>
        </div>
        <script src="{{ mix('js/backend.js') }}"></script>
    </body>
</html>
