<nav id="navbar-top" class="navbar navbar-expand-md navbar-dark text-white absolute-top">
    <div class="container">

        <button class="navbar-toggler order-2 order-md-1" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="col-5 collapse navbar-collapse order-3 order-md-2 px-0" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item mr-2">
                    <a class="nav-link text-dark" href="page-about.html">Home</a>
                </li>
                <li class="nav-item mr-2">
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
                <li class="nav-item dropdown active rounded">
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

<nav id="spotlight" class="bg-white shadow-inner pt-4">
    <div class="container">
        <div id="filter" class="d-flex mb-4">
            <h3 class="w-15 d-flex align-items-center mb-0 mr-2 text-orange">Looking for</h3>

            <select class="form-control-sm mr-2">
                <option value="all">Any Rates</option>
                <option value="">Official Rates</option>
                <option value="">Low Rates</option>
                <option value="">Mid Rates</option>
                <option value="">High Rates</option>
                <option value="">Super Rates</option>
                <option value="">Instant Rates</option>
            </select>

            <select class="form-control-sm mr-2">
                <option value="all">Any Mode</option>
                @foreach(\App\ServerMode::all() as $mode)
                    <option value="">{{ ucfirst($mode->name) }} Mode</option>
                @endforeach
            </select>

            <select class="form-control-sm mr-2">
                <option value="all">With Any Tags</option>
                @foreach(\App\Tag::all() as $tag)
                    <option>With {{ ucfirst($tag->name) }}</option>
                @endforeach
            </select>

            <select class="form-control-sm flex-fill">
                <option>Sort by Score</option>
                <option>Sort by Rank Position</option>
                <option>Sort by Date added</option>
                <option>Sort by Online since</option>
            </select>
        </div>
    </div>
</nav>

<div id="stage" class="pt-4 pb-4">

    <div class="container">
        <h4 class="title text-muted mb-0">Sponsored <i class="fas fa-info-circle"></i></h4>

        <div class="server-stage">

            @foreach(\App\Server::all()->random(5) as $server)
                <div class="carousel-cell mr-3">@include('partials/microcard', ['server' => $server])</div>
            @endforeach
        </div>
    </div>

</div>