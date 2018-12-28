@extends('layouts.frame')

@section('content')

    <?php /** @var \App\Listings\Listing $listing */ ?>

    <nav id="spotlight" class="bg-white shadow-inner">
        <div class="container py-3">
            <div class="row">
                <div class="col">
                    <span class="text-uppercase" style="padding: 15px 20px; font-size: smaller; border-right: 1px solid #e4e4e4;">
                        <a href="{{ route('index') }}" class="text-dark font-weight-bold">
                            <i class="fas fa-arrow-left"></i> Back to Main
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <div id="server-wrapper">
        <section id="curtain" class="bg-light">
            {{--<div id="screenshot" style="height:510px;">--}}
                {{--te--}}
            {{--</div>--}}
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <div class="labels mb-4 d-flex flex-row">
                            <ul class="list-unstyled mr-2">
                                <li>High Rate</li>
                            </ul>
                            <ul class="list-unstyled mr02">
                                <li>Other Tags</li>
                            </ul>
                        </div>
                        <h2 class="text-white font-weight-normal">{{ $listing->name }}</h2>
                        <div class="subheading mb-3">
                            <a href="{{ $listing->website }}" class="text-transparent">{{ $listing->website }}</a>
                        </div>
                        <div class="description mb-5">
                            <p class="text-white">{{ $listing->description }}</p>
                        </div>
                        <div class="stats mb-4">
                            <ul class="list-unstyled d-flex flex-row text-white font-weight-bold">
                                <li class="mr-3"><i class="fas fa-mouse-pointer"></i> {{ $listing->clicks_count }} Clicks</li>
                                <li class="mr-3"><i class="fas fa-poll-h"></i> {{ $listing->votes_count }} Votes</li>
                                {{--<li class="mr-3"><i class="fas fa-stethoscope"></i> Computed Score: {{ rand(1, 100) }}</li>--}}
                            </ul>
                        </div>
                        <div class="actions">
                            <a href="" class="btn btn-trans active">View Website</a>
                            <a href="" class="btn btn-trans">Write Review</a>
                            <a href="" class="btn btn-trans">Vote For Server</a>
                        </div>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <div class="">
                            <img class="rounded" src="{{ fake()->imageUrl(250, 250)  }}" alt="" width="100%">
                            <div class="stars d-flex flex-row text-white text-center mt-5">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                            </div>
                            {{--<div class="screenshots">--}}
                                {{--<carousel>--}}
                                    {{--<slide style="width:100px; height: 100px; background: white; margin-right:10px; border-radius: 10px;">--}}
                                        {{--<img src="http://ny-ro.com/screenshots/RMS_SS_01.jpg" alt="" width="150">--}}
                                    {{--</slide>--}}
                                    {{--<slide style="width:100px; height: 100px; background: white; margin-right:10px;  border-radius: 10px;">--}}
                                        {{--<img src="http://ny-ro.com/nyro/screenshots/rms_ss_05.jpg" alt="" width="150">--}}
                                    {{--</slide>--}}
                                {{--</carousel>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="configuration" class="bg-light">
            <div class="container p-5">
                <h3 class="heading mb-4 text-dark heading-underline">Server Configuration Setup</h3>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        @include('listing.partial.config', ['name'=>'Base Exp Rate', 'type' => 'exp', 'value' => $listing->configs['base_exp_rate']])
                        @include('listing.partial.config', ['name'=>'Job Exp Rate', 'type' => 'exp',  'value' => $listing->configs['job_exp_rate']])
                        @include('listing.partial.config', ['name'=>'Max Base Level', 'type' => 'exp',  'value' => $listing->configs['max_base_level']])
                        @include('listing.partial.config', ['name'=>'Max Job Level', 'type' => 'exp',  'value' => $listing->configs['max_job_level']])
                    </div>
                    <div class="col-4 d-flex flex-column">
                        @include('listing.partial.config', ['name'=>'Max Basic Stats', 'type' => 'stat',  'value' => $listing->configs['max_stats']])
                        @include('listing.partial.config', ['name'=>'Max ASPD', 'type' => 'stat',  'value' => $listing->configs['max_aspd']])
                        @include('listing.partial.config', ['name'=>'Instant Cast Stat', 'type' => 'stat',  'value' => 'Dex: '.$listing->configs['instant_cast_stat']])
                    </div>
                    <div class="col-4 d-flex flex-column">
                        @include('listing.partial.config', ['name'=>'Drop Base', 'type' => 'drop-base',  'value' => $listing->configs['drop_base_rate']])
                        @include('listing.partial.config', ['name'=>'Drop Base MVP', 'type' => 'drop-mvp-base',  'value' => $listing->configs['drop_base_mvp_rate']])
                        {{--@include('listing.partial.config', ['name'=>'Drop Base Special', 'type' => 'drop',  'value' => $listing->config->drop_base_special_rate])--}}
                        @include('listing.partial.config', ['name'=>'Drop Card', 'type' => 'drop-card',  'value' => $listing->configs['drop_card_rate']])
                        @include('listing.partial.config', ['name'=>'Drop Card MVP', 'type' => 'drop-mvp-card',  'value' => $listing->configs['drop_card_mvp_rate']])
                        {{--@include('listing.partial.config', ['name'=>'Drop Card Special', 'type' => 'drop',  'value' => $listing->config->drop_card_special_rate])--}}
                    </div>
                </div>
            </div>
        </section>

        <section id="ratings" class="bg-light">
            <div class="container pl-5 pr-5 pb-5">
                <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2);">
                    <h3 class="heading mb-4 text-dark heading-underline">Balance Ratings</h3>
                    <div class="row no-gutters">
                        @include('listing.partial.rating', ['name' => 'Donation Balance', 'description' => 'Can non-donators compete with donators.'])
                        @include('listing.partial.rating', ['name' => 'Update Balance', 'description' => 'Do update increase or improve balance each time.'])
                        @include('listing.partial.rating', ['name' => 'Class Balance', 'description' => 'Are classes equally as powerful.'])
                        @include('listing.partial.rating', ['name' => 'Item Balance', 'description' => 'Do items have reasonable stats against others.'])
                    </div>
                </div>
                <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2)">
                    <h3 class="heading mb-4 text-dark heading-underline">Server Ratings</h3>
                    <div class="row no-gutters">
                        @include('listing.partial.rating', ['name' => 'Support', 'description' => 'GMs are available and are happy to help.'])
                        @include('listing.partial.rating', ['name' => 'Hosting', 'description' => 'The availability and ping is playable and fun.'])
                        @include('listing.partial.rating', ['name' => 'Content', 'description' => 'There is much to do in game and frequently new stuff added.'])
                        @include('listing.partial.rating', ['name' => 'Events', 'description' => 'Events have good rewards and are usual.'])
                    </div>
                </div>

            </div>
        </section>

        <section id="reviews" class="bg-light">
            <div class="container pl-5 pr-5 pb-5">
                <h3 class="heading mb-4 text-dark heading-underline">Player Reviews</h3>
                <div class="reviews">
                    @include('listing.partial.review')
                    @include('listing.partial.review')
                    @include('listing.partial.review')
                    @include('listing.partial.review')
                    @include('listing.partial.review')
                </div>
            </div>
        </section>

    </div>

@endsection