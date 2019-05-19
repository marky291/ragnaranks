<nav id="navbar-top" class="navbar navbar-expand-md navbar-dark text-white absolute-top">
    <div class="tw-flex tw-container tw-mx-auto">
        <div class="tw-w-1/3 collapse navbar-collapse order-3 order-md-2 px-0" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item mr-2">
                    <a class="nav-link text-dark" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link text-dark" href="page-contact.html">Advertise</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="page-contact.html">API Integration</a>
                </li>
            </ul>
        </div>

        <a id="logo" class="tw-w-1/3  navbar-brand mx-auto order-1 order-md-3 font-weight-bold text-center" href="{{ route('index') }}">
            {{--Ragna<br><span id="under">Ranks</span>--}}
            <img src="{{ asset('img/logo.png') }}" alt="" style="height:64px; width: auto;">
        </a>

        <div class="tw-w-1/3 collapse tw-justify-end navbar-collapse order-4 order-md-4" id="navbar-right">
            <at-menu mode="horizontal" active-name="{{ request()->route()->uri }}" class="bg-transparent" @on-select="navigate">
                @if (auth()->check())
                    <at-menu-item name="notification">
                        <at-badge :value="1048" :max-num="12">
                            <span><i class="icon icon-bell"></i>Notifications</span>
                        </at-badge>
                    </at-menu-item>
                    <at-submenu>
                        <template slot="title"><i class="icon icon-user"></i>My Account</template>
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