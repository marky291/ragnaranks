@extends('layouts.frame')

@section('content')

    <?php /** @var \App\Listings\Listing $listing */ ?>

    <listing-profile inline-template>
        <div class="">
            <nav id="spotlight" class="bg-white shadow-inner" style="border-bottom: 1px solid #e4e4e4;">
                <div class="container py-3">
                    <div class="row">
                        <div class="col">
                            <span class="text-uppercase" style="padding: 15px 20px; font-size: smaller; border-right: 1px solid #e4e4e4;">
                                    <i class="fas fa-arrow-left"></i> Back to Main
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </nav>

            <div id="server-wrapper">
                <section id="curtain">
                    {{--<div id="screenshot" style="height:510px;">--}}
                    {{--te--}}
                    {{--</div>--}}
                    <div class="container p-5 my-5">
                        <div class="row">
                            <div class="col-8">
                                <h2 class="font-weight-normal">XileRO Private Server</h2>
                                <div class="labels mb-4 d-flex flex-row">
                                    <ul class="list-unstyled">
                                        @foreach($listing->tags as $tag)
                                            <li class="mr-2 flare {{ $tag->tag }}">{{ $tag->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="description mb-5">
                                    <p class="">{{ $listing->description }}</p>
                                </div>
                                {{--<div class="stats mb-4">--}}
                                    {{--<ul class="list-unstyled d-flex flex-row font-weight-bold">--}}
                                        {{--<li class="mr-3"><i class="fas fa-mouse-pointer mr-1"></i> {{ $listing->clicks_count }} Clicks</li>--}}
                                        {{--<li class="mr-3"><i class="fas fa-poll-h mr-1"></i> {{ $listing->votes_count }} Votes</li>--}}
                                        {{--<li class="mr-3"><i class="fas fa-stethoscope"></i> Computed Score: {{ rand(1, 100) }}</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                                <div class="actions">
                                    <a href="" class="btn btn-primary">View Website</a>
                                    <a href="" class="btn btn-outline-primary">Write Review</a>
                                    <a href="" class="btn btn-outline-primary">Vote For Server</a>
                                </div>
                            </div>
                            <div class="col-4 image" style="background: url('https://talonro.com/images/screenshots/talonro-port-malaya.jpg')"></div>
                        </div>
                    </div>
                </section>

                <section id="ratings">
                    <div class="container pl-5 pr-5">
                        <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2);">
                            <h3 class="heading mb-4 text-dark heading-underline">Balance Ratings</h3>
                            <div class="row no-gutters">
                                <scoreboards inline-template>
                                    <div class="d-flex">
                                        <scoreboard title="Donation Balance" description="Non-Donators can compete with Donators." :score="avg_donation_score"></scoreboard>
                                        <scoreboard title="Update Balance" description="Updates improve gameplay and balance each change." :score="avg_update_score"></scoreboard>
                                        <scoreboard title="Class Balance" description="Classes are balanced against other classes." :score="avg_class_score"></scoreboard>
                                        <scoreboard title="Item Balance" description="Item stats are fair and thought out." :score="avg_item_score"></scoreboard>
                                    </div>
                                </scoreboards>
                            </div>
                        </div>
                        <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2)">
                            <h3 class="heading mb-4 text-dark heading-underline">Server Ratings</h3>
                            <div class="row no-gutters">
                                <scoreboards inline-template>
                                    <div class="d-flex">
                                        <scoreboard title="Support" description="Non-Donators can compete with Donators." :score="avg_support_score"></scoreboard>
                                        <scoreboard title="Hosting" description="The availability and ping is playable and fun." :score="avg_hosting_score"></scoreboard>
                                        <scoreboard title="Content" description="There is much to do in game and frequently new stuff added." :score="avg_content_score"></scoreboard>
                                        <scoreboard title="Events" description="Rewards are good and events are regular." :score="avg_event_score"></scoreboard>
                                    </div>
                                </scoreboards></div>
                        </div>

                    </div>
                </section>

                <section id="configuration">
                    <div class="container p-5">
                        <h3 class="heading mb-4 text-dark heading-underline">Server Configuration Setup</h3>
                        <div class="row">
                            <div class="list col-4 d-flex flex-column">
                                @include('listing.partial.config', ['name'=>'Base Exp Rate', 'type' => 'exp', 'value' => $listing->configs['base_exp_rate']])
                                @include('listing.partial.config', ['name'=>'Job Exp Rate', 'type' => 'exp',  'value' => $listing->configs['job_exp_rate']])
                                @include('listing.partial.config', ['name'=>'Max Base Level', 'type' => 'exp',  'value' => $listing->configs['max_base_level']])
                                @include('listing.partial.config', ['name'=>'Max Job Level', 'type' => 'exp',  'value' => $listing->configs['max_job_level']])
                            </div>
                            <div class="list col-4 d-flex flex-column">
                                @include('listing.partial.config', ['name'=>'Max Basic Stats', 'type' => 'stat',  'value' => $listing->configs['max_stats']])
                                @include('listing.partial.config', ['name'=>'Max ASPD', 'type' => 'stat',  'value' => $listing->configs['max_aspd']])
                                @include('listing.partial.config', ['name'=>'Instant Cast Stat', 'type' => 'stat',  'value' => 'Dex: '.$listing->configs['instant_cast_stat']])
                            </div>
                            <div class="list col-4 d-flex flex-column">
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

                <div id="previews">
                    <div class="container px-5 pb-5">
                        <h3 class="heading mb-4 text-dark heading-underline">Screenshot Previews</h3>
                        <div class="mb-3">
                            <carousel :autoplay="true" :pagination-enabled="false" :navigation-enabled="true" :loop="true">
                                <slide>
                                    <img width="500" src="http://i12.photobucket.com/albums/a213/Ademist/screenXiLeROPK327-1.jpg" alt="">
                                </slide>
                                <slide>
                                    <img width="500" src="https://i.imgur.com/HqQckm8.jpg" alt="">
                                </slide>
                            </carousel>
                        </div>
                    </div>
                </div>

                <section id="reviews">
                    <div class="container pl-5 pr-5 pb-5 mb-5">
                        <h3 class="heading mb-4 text-dark heading-underline">Player Reviews</h3>

                        <reviews :data="{{ $listing->reviews->load('publisher') }}" policy="{{ auth()->check() && auth()->user()->can('review', $listing) }}"></reviews>

                    </div>
                </section>

            </div>
        </div>
    </listing-profile>

@endsection