<nav id="navbar-top" class="navbar navbar-expand-md navbar-dark text-white absolute-top">
    <div class="container">

        <button class="navbar-toggler order-2 order-md-1" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="col-5 collapse navbar-collapse order-3 order-md-2 px-0" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item mr-3">
                    <a class="nav-link text-dark" href="page-about.html">Home</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-dark" href="page-contact.html">Advertise</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="page-contact.html">API Integration</a>
                </li>
            </ul>
        </div>

        <a id="logo" class="col-2 navbar-brand mx-auto order-1 order-md-3 font-weight-bold text-center" href="{{ route('home') }}">
            {{--Ragna<br><span id="under">Ranks</span>--}}
            <img src="img/logo.png" alt="" style="height:64px; width: auto;">
        </a>

        <div class="col-5 collapse navbar-collapse order-4 order-md-4" id="navbar">
            <ul class="navbar-nav flex-fill justify-content-end">
                <li class="nav-item dropdown active">
                    <a class="nav-link" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="member d-flex flex-row align-items-center">
                            <div class="avatar">
                                <img src="{{ fake()->imageUrl(35,35) }}" alt="">
                            </div>
                            <div class="details mx-2 flex-grow-1" style="line-height: 1.1em">
                                <p class="mb-0">
                                    {{ fake()->userName }} <br>
                                    {{ rand(1,3) }} servers
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

<nav id="spotlight" class="bg-white shadow-inner">
    <div class="container">
        <div class="row">
            <div class="col-8 server-rates">
                <nav class="nav">
                    <a class="nav-link py-3 text-muted active" href="#">All</a>
                    <a class="nav-link py-3 text-muted" href="#">Low Rate</a>
                    <a class="nav-link py-3 text-muted" href="#">Mid Rate</a>
                    <a class="nav-link py-3 text-muted" href="#">High Rate</a>
                </nav>
            </div>
            <div class="col-4 justify-content-end align-self-center text-right">
                <a class="text-muted" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                </a>
            </div>
        </div>
    </div>
</nav>

<div id="stage" class="pt-4 pb-5">

    <div class="container">
        <h4 class="title text-muted mb-0">Sponsored <i class="fas fa-info-circle"></i></h4>

        <div class="server-stage">

            @foreach(\App\Server::all()->random(5) as $server)
                <div class="carousel-cell mr-3">@include('partials/microcard', ['server' => $server])</div>
            @endforeach
        </div>
    </div>

</div>