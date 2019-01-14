<nav id="navbar-top" class="navbar navbar-expand-md navbar-dark text-white absolute-top">
    <div class="container">

        <button class="navbar-toggler order-2 order-md-1" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="col-5 collapse navbar-collapse order-3 order-md-2 px-0" id="navbar">
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

        <a id="logo" class="col-2 navbar-brand mx-auto order-1 order-md-3 font-weight-bold text-center" href="{{ route('index') }}">
            {{--Ragna<br><span id="under">Ranks</span>--}}
            <img src="{{ asset('img/logo.png') }}" alt="" style="height:64px; width: auto;">
        </a>

        <div class="col-5 collapse navbar-collapse order-4 order-md-4" id="navbar">
            <ul class="navbar-nav flex-fill justify-content-end">
                <li class="nav-item mr-2">
                    @if(auth()->check())
                        <a class="nav-link text-dark" href="{{ route('logout') }}">Logout</a>
                    @else
                        <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
                    @endif
                </li>
                <li class="nav-item dropdown active rounded">
                    <a class="nav-link" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="member d-flex flex-row align-items-center">
                            {{--<div class="avatar">--}}
                                {{--<img src="{{ fake()->imageUrl(35,35) }}" alt="">--}}
                            {{--</div>--}}
                            <div class="details mx-2 flex-grow-1" style="line-height: 1.1em">
                                <p class="mb-0">
                                    {{--{{ fake()->userName }} <br>--}}
                                    Account
                                </p>
                            </div>
                            <div class="carrot">
                                <i class="fas fa-caret-down"></i>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown02">
                        <a class="dropdown-item" href="home-onecolumn.html">One column</a>
                        <a class="dropdown-item" href="home-twocolumn.html">Two column</a>
                        <a class="dropdown-item" href="home-threecolumn.html">Three column</a>
                        <a class="dropdown-item" href="home-fourcolumn.html">Four column</a>
                        <a class="dropdown-item" href="home-featured.html">Featured posts</a>
                        <a class="dropdown-item" href="home-fullwidth.html">Full width</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>