@extends('layouts.frame')

@section('content')

    <?php /** @var App\Server $server */ ?>

    @component('slots.spotlight')
        @slot('content')
            <div class="row">
                <div class="col-10 server-rates">
                    <div id="filter" class="d-flex py-4">
                        <h3 class="d-flex align-items-center mb-0 mr-4">I'm Looking for:</h3>

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

                        <select class="form-control-sm mr-2">
                            <option>Sorted by Score</option>
                            <option>Sorted by Rank Position</option>
                            <option>Sorted by Date added</option>
                            <option>Sorted by Online since</option>
                        </select>

                        <select class="form-control-sm">
                            <option>And show 50 servers</option>
                            <option>And show 100 servers</option>
                            <option>And show 250 servers</option>
                            <option>And show 500 servers</option>
                        </select>
                    </div>
                </div>
                <div class="col-2 justify-content-end align-self-center text-right">
                    Search Servers
                    <a class="text-muted" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                    </a>
                </div>
            </div>
        @endslot
    @endcomponent

    <section id="curtain">
        <div class="container px-5">
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

    <section id="configuration" class="bg-light">
        <div class="container p-5">
            <h3 class="heading mb-4 text-dark">Server Configuration Setup</h3>
            <div class="row">
                <div class="col-4 d-flex flex-column">
                    @include('server.partial.config', ['name'=>'Base Exp Rate', 'value' => $server->config->base_exp_rate])
                    @include('server.partial.config', ['name'=>'Job Exp Rate', 'value' => $server->config->job_exp_rate])
                    @include('server.partial.config', ['name'=>'Max Base Level', 'value' => $server->config->max_base_level])
                    @include('server.partial.config', ['name'=>'Max Job Level', 'value' => $server->config->max_job_level])
                </div>
                <div class="col-4 d-flex flex-column">
                    @include('server.partial.config', ['name'=>'Max Basic Stats', 'value' => $server->config->max_stats])
                    @include('server.partial.config', ['name'=>'Max ASPD', 'value' => $server->config-> max_aspd])
                    @include('server.partial.config', ['name'=>'Instant Cast Stat', 'value' => 'Dex: '.$server->config->instant_cast_stat])
                </div>
                <div class="col-4 d-flex flex-column">
                    @include('server.partial.config', ['name'=>'Drop Base', 'value' => $server->config->drop_base_rate])
                    @include('server.partial.config', ['name'=>'Drop Base MVP', 'value' => $server->config->drop_base_mvp_rate])
                    {{--@include('server.partial.config', ['name'=>'Drop Base Special', 'value' => $server->config->drop_base_special_rate])--}}
                    @include('server.partial.config', ['name'=>'Drop Card', 'value' => $server->config->drop_card_rate])
                    @include('server.partial.config', ['name'=>'Drop Card MVP', 'value' => $server->config->drop_card_mvp_rate])
                    {{--@include('server.partial.config', ['name'=>'Drop Card Special', 'value' => $server->config->drop_card_special_rate])--}}
                </div>
            </div>
        </div>
    </section>

    <section id="ratings">
        <div class="container p-5">
            <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2);">
                <h3 class="heading mb-4 text-dark">Balance Ratings</h3>
                <div class="row no-gutters">
                    @include('server.partial.rating', ['name' => 'Donation Balance', 'description' => 'Can non-donators compete with donators.'])
                    @include('server.partial.rating', ['name' => 'Update Balance', 'description' => 'Do update increase or improve balance each time.'])
                    @include('server.partial.rating', ['name' => 'Class Balance', 'description' => 'Are classes equally as powerful.'])
                    @include('server.partial.rating', ['name' => 'Item Balance', 'description' => 'Do items have reasonable stats against others.'])
                </div>
            </div>
            <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2)">
                <h3 class="heading mb-4 text-dark">Server Ratings</h3>
                <div class="row no-gutters">
                    @include('server.partial.rating', ['name' => 'Support', 'description' => 'GMs are available and are happy to help.'])
                    @include('server.partial.rating', ['name' => 'Hosting', 'description' => 'Server is hosted in a good place with no-lag or spikes.'])
                    @include('server.partial.rating', ['name' => 'Content', 'description' => 'There is much to do in game and frequently new stuff added.'])
                    @include('server.partial.rating', ['name' => 'Events', 'description' => 'Events have good rewards and are usual.'])
                </div>
            </div>

        </div>
    </section>

    <section id="reviews" class="mt-4">
        <div class="container p-5">
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