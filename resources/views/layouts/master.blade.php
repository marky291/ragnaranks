<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        @yield('meta_tags')
        <meta name="robots" content="all">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="@yield('canonical', '')" rel="canonical">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <meta name="viewport" content="width=device-width, initial -scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"></head>
    <body>
        <div id="app" class="min-width:1200px">
            <nav id="rr-navbar" class="tw-shadow-md">
                <div class="tw-container tw-flex tw-items-center tw-py-3 lg:tw-py-4">
                    <div id="nav-left" class="tw-flex-1 tw-hidden xl:tw-block lg:tw-self-end">
                        <ul class="tw-flex">
                            <li class="nav-item tw-text-sm {{ request()->route()->named('index') ? 'active' : '' }}">
                                <a href="/" class="tw-px-4 tw-block"><i class="icon icon-home"></i> Home</a>
                            </li>
                            <li class="nav-item tw-text-sm {{ request()->route()->named('listing.create') ? 'active' : '' }}">
                                <a href="/listing/create" class="tw-px-4 tw-block"><i class="icon icon-plus-circle"></i> Create Listing</a>
                            </li>
                            <li class="nav-item tw-text-sm">
                                <a href="https://ragnaranks.github.io/docs/" class="tw-px-4 tw-block"><i class="icon icon-align-left"></i> Get Help</a>
                            </li>
                        </ul>
                    </div>

                    <div id="logo" class="">
                        <a href="{{ route('index') }}" class="tw-m-auto">
                            <img src="{{ secure_asset('img/logo.png') }}" class="tw-m-auto tw-hidden lg:tw-block" alt="" style="height:64px; width: auto;">
                            <span class="tw-flex tw-items-center tw-text-white tw-rounded-r-lg lg:tw-hidden">
                    <img src="{{ secure_asset('img/logo-mobile.jp2') }}" class="tw-border-white tw-shadow lg:tw-hidden tw-block tw-rounded" alt="" style="height:64px; width: auto;">
                    <h2 class="tw-mb-0 tw-tracking-tight tw-normal-case tw-mt-1 tw-ml-3 tw-text-lg tw-text-gray-200">RagnaRanks<br><span class="tw-text-xs">Mobile Mode</span></h2>
                </span>
                        </a>
                    </div>

                    <div id="nav-right" class="tw-flex-1 tw-flex tw-justify-end lg:tw-self-end">
                        <ul class="tw-flex tw-hidden lg:tw-flex tw-flex-1 tw-justify-end">
                            <li class="nav-item tw-hidden lg:tw-block xl:tw-hidden tw-text-sm {{ request()->route()->named('index') ? 'active' : '' }}">
                                <a href="/" class="tw-px-4 tw-block"><i class="icon icon-home"></i> Home</a>
                            </li>
                            <li class="nav-item tw-hidden lg:tw-block xl:tw-hidden tw-text-sm {{ request()->route()->named('listing.create') ? 'active' : '' }}">
                                <a href="/listing/create" class="tw-px-4 tw-block"><i class="icon icon-plus-circle"></i> Create Listing</a>
                            </li>
                            <li class="nav-item tw-hidden lg:tw-block xl:tw-hidden tw-text-sm">
                                <a href="https://ragnaranks.github.io/docs/" class="tw-px-4 tw-block"><i class="icon icon-align-left"></i> Get Help</a>
                            </li>
                            @if(auth()->check())
                                <li class="nav-item tw-text-sm {{ request()->route()->named('myAccount') ? 'active' : '' }}">
                                    <a href="/account" class="tw-px-4 tw-block"><i class="icon icon-user"></i> Account</a>
                                </li>
                                <li class="nav-item tw-text-sm {{ request()->route()->named('notifications') ? 'active' : '' }}">
                                    <a href="/account/notifications" class="tw-px-4 tw-block"><i class="icon icon-user"></i> Notifications</a>
                                    <div class="badge">{{ auth()->user()->unreadNotifications->count() }}</div>
                                </li>
                                <li class="nav-item tw-px-4 tw-text-sm {{ request()->route()->named('logout') ? 'active' : '' }}">
                                    <a href="{{ route('logout') }}" class="tw-px-4 tw-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i class="icon icon-user"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @else
                                <li class="nav-item tw-text-sm {{ request()->route()->named('login') ? 'active' : '' }}">
                                    <a href="/login" class="tw-px-4 tw-block"><i class="icon icon-user"></i> Login</a>
                                </li>
                                <li class="nav-item tw-text-sm {{ request()->route()->named('register') ? 'active' : '' }}">
                                    <a href="/register" class="tw-px-4 tw-block"><i class="icon icon-user-plus"></i> Register</a>
                                </li>
                            @endif
                        </ul>
                        <ul class="tw-flex lg:tw-hidden" id="mobile-nav-right">
                            <li class="tw-px-4">
                                <i class="icon icon-filter tw-text-xl"></i>
                            </li>
                            <li class="tw-px-4">
                                <i class="icon icon-align-justify tw-text-xl"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('wrapper')

            <footer class="shadow-inner">
                <div class="tw-container d-flex mb-5">
                    <div class="tw-flex-1  mr-5">
                        <h2 class="pb-1">RagnaRanks</h2>
                        <p>
                            Our web-service is designed in a way that allows you to easily find the server
                            you are searching for in the box of never ending server advertisements, we accomplish this
                            by utilising tags, filters and keyword searching throughout all of our cards, this allows
                            you to easily narrow down a specific search and discover servers you would have never
                            found otherwise.
                        </p>
                        <div class="social pt-2">
                            <a href="https://www.facebook.com/ragnaranks/" class="tw-text-2xl"><i class="fab fa-facebook text-white mr-2"></i></a>
                            <a href="http://discord.gg/WGSAce2" class="tw-text-2xl"><i class="fab fa-discord text-white mr-2"></i></a>
                            <a href="https://www.reddit.com/r/RagnaRanks/" class="tw-text-2xl"><i class="fab fa-reddit-square text-white mr-2"></i></a>
                        </div>
                    </div>
                    <div class="tw-hidden lg:tw-flex tw-flex-1" style="justify-content: space-evenly">
                        <div>
                            <h2>Docs</h2>
                            <ul class="list-unstyled list">
                                <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm" href="https://ragnaranks.github.io/docs/listing.html">Creating a new Listing</a></li>
                                <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm" href="https://ragnaranks.github.io/docs/vote4points.html">Vote For Points Setup</a></li>
                                <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm" href="https://ragnaranks.github.io/docs/listing.html">Documentation Overview</a></li>
                            </ul>
                        </div>
                        <div>
                            <h2>Actions</h2>
                            <ul class="list-unstyled list">
                                <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm" href="https://www.reddit.com/r/RagnaRanks">Share your ideas</a></li>
                                <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm"  href="/listing/create">Create a new Listing</a></li>
                                <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm"  href="https://www.facebook.com/ragnaranks/">Message us for Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="copyrights" class="container text-center rounded-top">
                    <p class="text-transparent mb-0">©Ragnaranks 2020. All Rights belong to Respective Owners. Ver {{ config('app.version') }}</p>
                    <p class="text-transparent mb-0">
                        Developed and Designed by <a class=text-white href="https://www.facebook.com/Marky291">Mark Hester</a>,
                        with special thanks to Rainer Popowski & Zurina Johnston for their insight.
                    </p>
                </div>
            </footer>
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
            // ga('require', 'impressionTracker');
            // ga('require', 'maxScrollTracker');
            // ...

            ga('send', 'pageview');
        </script>
        <script src="https://kit.fontawesome.com/fd57eb34f0.js"></script>
        <script async src="https://www.google-analytics.com/analytics.js"></script>
        <script async src="https://ragnabox.fra1.digitaloceanspaces.com/assets/autotrack-2.4.1.js"></script>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-2280364578236676",
                enable_page_level_ads: true
            });
        </script>
        @yield('js')
    </body>
</html>
