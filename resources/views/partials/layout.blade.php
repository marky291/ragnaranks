<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ url('css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script type="jscript" src="{{ url('js/app.js') }}"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    </head>
    <body>

        <div class="header-background">
            <div class="container">
                <header class="py-3 px-4 border-b rounded-bottom">
                    <div class="row flex-nowrap justify-content-between align-items-center">
                        <div class="col-4 pt-1">
                            <div class="nav-scroller">
                                <nav class="nav d-flex">
                                    <a class="px-2 text-muted" href="#">Server Listings</a>
                                    <a class="px-2 text-muted" href="#">Get Gold</a>
                                    <a class="px-2 text-muted" href="#">Integration</a>
                                </nav>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <a class="header text-dark website-name" href="#">Project Magnolia</a>
                        </div>
                        <div class="col-4 d-flex justify-content-end align-items-center">
                            <a class="text-muted" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                            </a>
                            <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
                        </div>
                    </div>
                </header>
            </div>
        </div>

        <div class="body-background" id="filters">
            <div class="container rounded">
                @yield('content')
            </div>
        </div>


    </body>
</html>
