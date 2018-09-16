<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ url('assets/app.css') }}">
        <script type="jscript" src="{{ url('assets/app.js') }}"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <header class="py-3 border-b">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-4 pt-1">
                        <a class="text-muted" href="#">Subscribe</a>
                    </div>
                    <div class="col-4 text-center">
                        <a class="header text-dark text-lg" href="#">Project Magnolia</a>
                    </div>
                    <div class="col-4 d-flex justify-content-end align-items-center">
                        <a class="text-muted" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                        </a>
                        <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
                    </div>
                </div>
            </header>
            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex">
                    <a class="p-2 text-muted" href="#">Server Listings</a>
                    <a class="p-2 text-muted" href="#">App API</a>
                </nav>
            </div>
            @yield('content')
        </div>


    </body>
</html>
