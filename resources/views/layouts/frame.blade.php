<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>@yield('title', 'RagnaRanks.com')</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=1200"/>
        <meta name="Description" content="@yield('description', 'Browse hundreds of ragnarok online private server listings, with advanced filtering, reviews & voting we make it a breeze.')">

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
        <script>
            window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
            ga('create', 'UA-117148224-4', 'auto');

            // Replace the following lines with the plugins you want to use.
            ga('require', 'eventTracker');
            ga('require', 'outboundLinkTracker');
            ga('require', 'urlChangeTracker');
            // ga('require', 'pageVisibilityTracker');
            ga('require', 'impressionTracker');
            // ga('require', 'maxScrollTracker');
            // ...

            ga('send', 'pageview');
        </script>
        <script async src="https://www.google-analytics.com/analytics.js"></script>
        <script async src="https://ragnabox.fra1.digitaloceanspaces.com/assets/autotrack-2.4.1.js"></script>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-2280364578236676",
                enable_page_level_ads: true
            });
        </script>
    </body>
</html>
