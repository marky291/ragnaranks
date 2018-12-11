@extends('layouts.frame')

@section('content')

    <?php /** @var App\Server $server */ ?>

    <section id="curtain">
        <div class="container p-5">
            <div class="row">
                <div class="col-7">
                    <div class="labels mb-4">
                        <ul class="list-unstyled">
                            <li>High Rate</li>
                        </ul>
                    </div>
                    <h2 class="text-white font-weight-normal">{{ $server->name }}</h2>
                    <div class="subheading mb-3">
                        <a href="{{ $server->website }}" class="text-transparent">{{ $server->website }}</a>
                    </div>
                    <div class="description mb-5">
                        <p class="text-white">{{ $server->description }}</p>
                    </div>
                    <div class="stats mb-4">
                        <ul class="list-unstyled d-flex flex-row text-white font-weight-bold">
                            <li class="mr-3"><i class="fas fa-mouse-pointer"></i> {{ $server->clicks_count }} Clicks</li>
                            <li class="mr-3"><i class="fas fa-poll-h"></i> {{ $server->votes_count }} Votes</li>
                            <li class="mr-3"><i class="fas fa-stethoscope"></i> Computed Score: {{ rand(1, 100) }}</li>
                        </ul>
                    </div>
                    <div class="actions">
                        <a href="" class="btn btn-trans active">View Website</a>
                        <a href="" class="btn btn-trans">Write Review</a>
                        <a href="" class="btn btn-trans">Vote on Server</a>
                    </div>
                </div>
                <div class="col-3 offset-2 d-flex align-items-center">
                    <div class="">
                        <img class="rounded screenshot" src="{{ url("https://www.novaragnarok.com/themes/new/img/memberLoginLogo.png") }}" alt="" width="100%">
                        <div class="stars d-flex flex-row text-white text-center mt-5">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="configuration" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-red pt-4">Base and Job Rates</h3>
                    <div class="d-flex flex-row">
                        <div class="block">
                            <div class="name">Max Base Level</div>
                            <div class="value">{{ $server->config->max_base_level }}</div>
                        </div>
                        <div class="block">
                            <div class="name">Max Job Level</div>
                            <div class="value">{{ $server->config->max_job_level }}</div>
                        </div>
                        <div class="block">
                            <div class="name">Base Exp Rate</div>
                            <div class="value">{{ $server->config->base_exp_rate }}x</div>
                        </div>
                        <div class="block">
                            <div class="name">Job Exp Rate</div>
                            <div class="value">{{ $server->config->job_exp_rate }}x</div>
                        </div>
                    </div>
                    <h3 class="text-red pt-4">Character Stats</h3>
                    <div class="d-flex flex-row">
                        <div class="block">
                            <div class="name">ASPD Max Stat</div>
                            <div class="value">{{ $server->config->max_aspd }}</div>
                        </div>
                        <div class="block">
                            <div class="name">Max Stats</div>
                            <div class="value">{{ $server->config->max_stats }}</div>
                        </div>
                        <div class="block">
                            <div class="name">Instant Cast Rate</div>
                            <div class="value">{{ $server->config->instant_cast_stat }}x</div>
                        </div>
                    </div>
                    <h3 class="text-red pt-4">Drop Rates</h3>
                    <div class="d-flex flex-row">
                        <div class="block">
                            <div class="name">Drop Base</div>
                            <div class="value">{{ $server->config->drop_base_rate }}x</div>
                        </div>
                        <div class="block">
                            <div class="name">Drop Base MVP</div>
                            <div class="value">{{ $server->config->drop_base_mvp_rate }}x</div>
                        </div>
                        <div class="block">
                            <div class="name">Drop Special Base</div>
                            <div class="value">{{ $server->config->drop_base_special_rate }}x</div>
                        </div>
                        <div class="block">
                            <div class="name">Drop Card Base</div>
                            <div class="value">{{ $server->config->drop_base_rate }}x</div>
                        </div>
                        <div class="block">
                            <div class="name">Drop Card MVP</div>
                            <div class="value">{{ $server->config->drop_base_mvp_rate }}x</div>
                        </div>
                        <div class="block">
                            <div class="name">Drop Special Card</div>
                            <div class="value">{{ $server->config->drop_base_special_rate }}x</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ratings" class="py-4">
        <div class="container py-3 mb-3 rounded" style="background: #ff627666; border:1px solid rgba(255, 255, 255, 0.2);">
            <h3 class="text-white font-weight-normal mb-3">Balance Ratings</h3>
            <div class="row no-gutters">
                <div class="col mr-2 bg-white p-3 d-flex align-items-center rounded">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex align-items-center mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Donation Balance</h4>
                            <p class="mb-0">Can non-donators compete with donators</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center rounded">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex align-items-center mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Update Balance</h4>
                            <p class="mb-0">Do update increase or improve balance each time</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center rounded">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex align-items-center  mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Class Balance</h4>
                            <p class="mb-0">Are classes equally as powerful.</p>
                        </div>
                    </div>
                </div>
                <div class="col bg-white p-3 d-flex align-items-center rounded">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex align-items-center  mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Item Balance</h4>
                            <p class="mb-0">Do items have reasonable stats against others.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-3 mb-3 rounded" style="background: #ff627666; border:1px solid rgba(255, 255, 255, 0.2)">
            <h3 class="text-white font-weight-normal mb-3">Server Ratings</h3>
            <div class="row no-gutters">
                <div class="col mr-2 bg-white p-3 d-flex align-items-center rounded">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex align-items-center  mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Support</h4>
                            <p class="mb-0">GMs are available and are happy to help</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center rounded">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex align-items-center  mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Hosting</h4>
                            <p class="mb-0">Server is hosted in a good place with no-lag or spikes</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center rounded">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex align-items-center  mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Content</h4>
                            <p class="mb-0">There is much to do in game and frequently new stuff added.</p>
                        </div>
                    </div>
                </div>
                <div class="col p-3 bg-white d-flex align-items-center rounded">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex align-items-center  mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Events</h4>
                            <p class="mb-0">Events are made reasonably by staff and are of quality and rewards.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="reviews" class="mt-4">
        <div class="container">
            <div class="reviews">
                <h2>Reviews</h2>
                <div class="review p-4 d-flex flex-row rounded">
                    <div class="profile d-flex flex-column mr-4">
                        <img class="avatar rounded-circle mb-2" src="{{ fake()->imageUrl(50, 50) }}" alt="Profile Avatar Image" width="50">
                        {{--<small class="subheading level font-weight-bold text-center">Level {{ rand(1, 10) }}</small>--}}
                    </div>
                    <div class="content">
                        <div class="h5"><span class="font-weight-bold text-black">{{ fake()->userName }}</span>
                            <small>• {!! fake()->dateTimeThisMonth('now')->format('d M Y') !!}</small></div>
                        <p>{{ fake()->sentence(200) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection