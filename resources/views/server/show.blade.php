@extends('layouts.frame')

@section('content')

    <?php /** @var App\Server $server */ ?>

    <div class="server container mt-5">
        
        <div class="row">
            <div class="col-9">
                <h2 class="text-dark">{{ $server->name }}</h2>
                <div class="subheading mb-2">
                    <a href="{{ url($server->website) }}">{{ $server->website }}</a>
                </div>
                <div class="description">
                    <p>{{ $server->description }}</p>
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
        <div class="container">
            <div class="row">
                <div class="col-7 d-flex flex-column">
                    <div class="flex-fill">
                        <h3 class="text-dark">Reviews</h3>
                        <div class="row">
                            <div class="review border rounded p-2 mr-2 mb-2" style="width: 18rem">
                                <h5>Review #{{ rand(1, 50) }}</h5>
                                <p>{{ fake()->paragraph }}</p>
                            </div>
                            <div class="review border rounded p-2 mr-2 mb-2" style="width: 18rem">
                                <h5>Review #{{ rand(1, 50) }}</h5>
                                <p>{{ fake()->paragraph }}</p>
                            </div>
                            <div class="review border rounded p-2 mr-2 mb-2" style="width: 18rem">
                                <h5>Review #{{ rand(1, 50) }}</h5>
                                <p>{{ fake()->paragraph }}</p>
                            </div>
                            <div class="review border rounded p-2 mr-2 mb-2" style="width: 18rem">
                                <h5>Review #{{ rand(1, 50) }}</h5>
                                <p>{{ fake()->paragraph }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light screenshots p-3">
                        <h3 class="text-dark">Screenshots (Flickr Slider)</h3>
                        <div class="d-flex">
                            <img class="screenshot mr-2" src="https://www.anomalyro.com/resources/screenshots/1.jpg" alt="" height="90" width="120">
                            <img class="screenshot mr-2" src="https://www.anomalyro.com/resources/screenshots/2.jpg" alt="" height="90" width="120">
                            <img class="screenshot mr-2" src="https://www.anomalyro.com/resources/screenshots/3.jpg" alt="" height="90" width="120">
                            <img class="screenshot mr-2" src="https://www.anomalyro.com/resources/screenshots/4.jpg" alt="" height="90" width="120">
                        </div>
                    </div>
                </div>
                <div class="col-5">
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
                        <tr>
                            <th scope="row"><img src="http://file5.ratemyserver.net/items/small/512.gif" alt="" height="25" width="25">Drop Base Rate</th>
                            <td>{{ $server->config->drop_base_rate }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><img src="http://file5.ratemyserver.net/items/small/512.gif" alt="" height="25" width="25">Drop Rate MVP Base</th>
                            <td>{{ $server->config->drop_base_mvp_rate }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><img src="http://file5.ratemyserver.net/items/small/512.gif" alt="" height="25" width="25">Drop Base Special Rate</th>
                            <td>{{ $server->config->drop_base_special_rate }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><img src="http://file5.ratemyserver.net/items/small/card.gif" alt="" height="25" width="25">Drop Card Rate</th>
                            <td>{{ $server->config->drop_card_rate }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><img src="http://file5.ratemyserver.net/items/small/card.gif" alt="" height="25" width="25">Drop Card MVP Rate</th>
                            <td>{{ $server->config->drop_card_mvp_rate }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><img src="http://file5.ratemyserver.net/items/small/card.gif" alt="" height="25" width="25">Drop Card Special Rate</th>
                            <td>{{ $server->config->drop_card_special_rate }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

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

@endsection