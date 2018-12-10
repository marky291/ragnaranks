@extends('layouts.frame')

@section('content')

    <?php /** @var App\Server $server */ ?>

    <section id="server-profile">
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
                        <img class="rounded screenshot" src="{{ fake()->imageUrl(500,500) }}" alt="" width="100%">
                        <div class="stars d-flex flex-row text-white text-center mt-4">
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

    <section id="configuration">
        <div class="container d-flex flex-row">
            <div class="block">
                <div class="value">{{ $server->config->max_base_level }}</div>
                <div class="name">Max Base Level</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->max_job_level }}</div>
                <div class="name">Max Job Level</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->max_aspd }}</div>
                <div class="name">ASPD Max Stat</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->max_stats }}</div>
                <div class="name">Max Stats</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->base_exp_rate }}x</div>
                <div class="name">Base Exp Rate</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->job_exp_rate }}x</div>
                <div class="name">Job Exp Rate</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->instant_cast_stat }}x</div>
                <div class="name">Instant Cast Rate</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->drop_base_rate }}x</div>
                <div class="name">Drop Base</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->drop_base_mvp_rate }}x</div>
                <div class="name">Drop Base MVP</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->drop_base_special_rate }}x</div>
                <div class="name">Drop Special Base</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->drop_base_rate }}x</div>
                <div class="name">Drop Card Base</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->drop_base_mvp_rate }}x</div>
                <div class="name">Drop Card MVP</div>
            </div>
            <div class="block">
                <div class="value">{{ $server->config->drop_base_special_rate }}x</div>
                <div class="name">Drop Special Card</div>
            </div>
        </div>
    </section>

    <div class="server container mt-5">
        <div class="row">
            <div class="col-9">
                <h2 class="text-dark">{{ $server->name }}</h2>
                <div class="subheading mb-2">
                    <a href="{{ url($server->website) }}">{{ $server->website }}</a>
                </div>
                <div class="description">
                    <p>{{ fake()->sentence(300) }}</p>
                </div>
            </div>
            <div class="col-3 d-flex flex-column justify-content-end">
                <a class="btn btn-outline-primary mb-2" href="">Go To Website</a>
                <a class="btn btn-outline-primary mb-2" href="">Cast a Vote</a>
                <a class="btn btn-outline-primary mb-2" href="">Create a Review</a>
            </div>
        </div>
    </div>

    <section class="mt-4">
        <div class="container bg-light py-3 mb-3 rounded">
            <h3 class="text-dark mb-3">Balance Ratings</h3>
            <div class="row no-gutters">
                <div class="col mr-2 bg-white p-3 d-flex align-items-center">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Donation Balance</h4>
                            <p class="mb-0">Can non-donators compete with donators</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Update Balance</h4>
                            <p class="mb-0">Do update increase or improve balance each time</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Class Balance</h4>
                            <p class="mb-0">Are classes equally as powerful.</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex mr-3" style="font-size: 3rem">
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
        <div class="container bg-light py-3 mb-3 rounded">
            <h3 class="text-dark mb-3">Server Ratings</h3>
            <div class="row no-gutters">
                <div class="col mr-2 bg-white p-3 d-flex align-items-center">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Support</h4>
                            <p class="mb-0">GMs are available and are happy to help</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Hosting</h4>
                            <p class="mb-0">Server is hosted in a good place with no-lag or spikes</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex mr-3" style="font-size: 3rem">
                            {!! ColorScaleCounter(rand(1, 10)) !!}
                        </div>
                        <div class="text">
                            <h4>Content</h4>
                            <p class="mb-0">There is much to do in game and frequently new stuff added.</p>
                        </div>
                    </div>
                </div>
                <div class="col mr-2 bg-white p-3 d-flex align-items-center">
                    <div class="rating-block d-flex flex-row">
                        <div class="rating w-25 d-flex mr-3" style="font-size: 3rem">
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

    <section class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3 class="text-dark">Server Configuration</h3>
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-light">
                            <th scope="col">Config</th>
                            <th scope="col">Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">Max Base Level</th>
                            <td>{{ $server->config->max_base_level }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Max Job Level</th>
                            <td>{{ $server->config->max_job_level }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Max ASPD</th>
                            <td>{{ $server->config->max_aspd }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Max Stat Level</th>
                            <td>{{ $server->config->max_stats }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Base Exp Rate</th>
                            <td>{{ $server->config->base_exp_rate }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Base Job Rate</th>
                            <td>{{ $server->config->job_exp_rate }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Instance Cast Stat</th>
                            <td>{{ $server->config->instant_cast_stat }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <h3 class="text-dark">Drop Rates & EXP</h3>
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-light">
                            <th scope="col">Config</th>
                            <th scope="col">Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">Drop Base Rate</th>
                            <td>{{ $server->config->drop_base_rate }}x</td>
                        </tr>
                        <tr>
                            <th scope="row">Drop Rate MVP Base</th>
                            <td>{{ $server->config->drop_base_mvp_rate }}x</td>
                        </tr>
                        <tr>
                            <th scope="row">Drop Base Special Rate</th>
                            <td>{{ $server->config->drop_base_special_rate }}x</td>
                        </tr>
                        <tr>
                            <th scope="row">Drop Card Rate</th>
                            <td>{{ $server->config->drop_card_rate }}x</td>
                        </tr>
                        <tr>
                            <th scope="row">Drop Card MVP Rate</th>
                            <td>{{ $server->config->drop_card_mvp_rate }}x</td>
                        </tr>
                        <tr>
                            <th scope="row">Drop Card Special Rate</th>
                            <td>{{ $server->config->drop_card_special_rate }}x</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-4">
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