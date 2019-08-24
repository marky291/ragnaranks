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
