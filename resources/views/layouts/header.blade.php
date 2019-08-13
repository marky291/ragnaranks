<nav id="rr-navbar" class="tw-shadow-md">
    <div class="tw-container tw-flex tw-items-center">
        <div id="nav-left" class="tw-flex-1">
            <ul class="tw-flex tw-list-reset">
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

        <div id="logo" class="tw-flex-1 tw-text-center">
            <a href="{{ route('index') }}">
                <img src="{{ asset('img/logo.png') }}" alt="" style="height:64px; width: auto;">
            </a>
        </div>

        <div id="nav-right" class="tw-flex-1 tw-flex tw-justify-end">
            <ul class="tw-flex tw-list-reset">
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
        </div>
    </div>

</nav>
