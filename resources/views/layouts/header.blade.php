<nav id="navbar-top" class="navbar tw-shadow-md navbar-expand-md navbar-dark text-white absolute-top">
    <div class="tw-flex tw-container tw-mx-auto">
        <div class="tw-w-1/3 collapse navbar-collapse order-3 order-md-2 px-0" id="navbar-left">
            <at-menu mode="horizontal" active-name="{{ request()->route()->uri }}" class="bg-transparent" @on-select="navigate">
                <at-menu-item name="/">
                    <span><i class="icon icon-home"></i>Home</span>
                </at-menu-item>
                <at-menu-item name="listing/create">
                    <span><i class="icon icon-tag"></i>Add Your Server</span>
                </at-menu-item>
            </at-menu>

        </div>

        <a id="logo" class="tw-w-1/3  navbar-brand mx-auto order-1 order-md-3 font-weight-bold text-center" href="{{ route('index') }}">
            {{--Ragna<br><span id="under">Ranks</span>--}}
            <img src="{{ asset('img/logo.png') }}" alt="" style="height:64px; width: auto;">
        </a>

        <div class="tw-w-1/3 collapse tw-justify-end navbar-collapse order-4 order-md-4" id="navbar-right">
            <at-menu mode="horizontal" active-name="{{ request()->route()->uri }}" class="bg-transparent" @on-select="navigate">
                @if (auth()->check())
                    <at-menu-item name="account/notifications">
                        <at-badge :value="{{ auth()->user()->unreadNotifications->count() }}" :max-num="12">
                            <span><i class="icon icon-bell"></i>Notifications</span>
                        </at-badge>
                    </at-menu-item>
                    <at-submenu>
                        <template slot="title"><i class="icon icon-user"></i>{{ auth()->user()->username }}</template>
                        <at-menu-item name="account"><i class="icon icon-settings"></i>My Account</at-menu-item>
                        @can('moderate')
                        <at-menu-item name="moderate/report"><i class="icon icon-alert-octagon"></i>Moderator Tools</at-menu-item>
                        @endcan
                        @role('creator')
                        <at-menu-item name="account/servers"><i class="icon icon-settings"></i>My Listings</at-menu-item>
                        @endrole
                        <at-menu-item name="logout"><i class="icon icon-settings"></i>Logout</at-menu-item>
                    </at-submenu>
                @else
                    <at-menu-item name="login">
                        <span><i class="icon icon-bell"></i>Login</span>
                    </at-menu-item>
                    <at-menu-item name="register">
                        <span><i class="icon icon-bell"></i>Register</span>
                    </at-menu-item>
                @endif
            </at-menu>
        </div>
    </div>
</nav>