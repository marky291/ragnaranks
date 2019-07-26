<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RagnaRanks.com</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ url('css/app.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>

    <body>

        <div id="app">

            @include('layouts.header')

            @yield('content')

            @include('layouts.footer')

        </div>

        <script src="{{ mix('/js/app.js') }}"></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        @if (app()->environment('production'))
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117148224-4"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-117148224-4');
            </script>
        @endif
    </body>
</html>