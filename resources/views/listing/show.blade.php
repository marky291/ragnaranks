@extends('layouts.frame')

@section('content')

    <?php /** @var \App\Listings\Listing $listing */ ?>
    <?php /** @var \App\Tag $tag */ ?>

    <listing-profile voted="{{ $listing->votes()->hasClientInteractedWith(config('interaction.vote.spread')) }}" clicked="{{ $listing->clicks()->hasClientInteractedWith(config('interaction.click.spread')) }}" inline-template>

        <div class="">
{{--            <nav id="spotlight" class="bg-white shadow-inner" style="border-bottom: 1px solid #e4e4e4;">--}}
{{--                <div class="container py-3">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <span class="text-uppercase" style="padding: 15px 20px; font-size: smaller; border-right: 1px solid #e4e4e4;">--}}
{{--                                <a href="{{ route('index') }}">--}}
{{--                                    <i class="fas fa-arrow-left"></i> Back to Main--}}
{{--                                </a>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </nav>--}}

            <div class="container mt-3">
                <div class="row">
                    <div id="sidebar" class="col-4 py-5">
                        <div>
                            <div class="content">
                                <h3 class="text-orange font-weight-bold">Site Messages</h3>
                                <p class="subheading">We are always interested in listening to feedback and improving our
                                    service, let your voice be heard at our subredit <a href="https://www.reddit.com/r/RagnaRanks">r/Ragnaranks</a>
                                </p>
                            </div>

                            <div class="heading">
                                <h3>User Actions</h3>
                            </div>
                            <div id="user-actions" class="content py-0 rounded py-3 d-flex flex-column">
                                <at-button class="mb-2" type="primary" hollow>Back to Searching</at-button>
                                <at-button class="mb-2" hollow>Visit Website</at-button>
                                <at-button class="mb-2" hollow>Vote for Server</at-button>
                            </div>

                            {{--<div class="heading">--}}
                            {{--<h3>Weekly Mentions</h3>--}}
                            {{--</div>--}}
                            {{--<div id="awards" class="content py-0">--}}
                            {{--@include('partials.sidebar.statistic', [--}}
                            {{--                            {{-listinger' => App\Listings::HighestVoteTrend()->first(),--}}{{----}}
                            {{--'message' => "Top Trending Votes",--}}
                            {{--'column' => 'votes_trend',--}}
                            {{--])--}}
                            {{--@include('partials.sidebar.statistic', [--}}
                            {{--                            {{-listinger' => App\Listings::HighestClickTrend()->first(),--}}{{----}}
                            {{--'message' => "Top Trending Visits",--}}
                            {{--'column' => 'clicks_trend',--}}
                            {{--])--}}
                            {{--</div>--}}

{{--                            <div class="heading">--}}
{{--                                <h3>Filtered Search</h3>--}}
{{--                            </div>--}}

                            {{--                        <filtered-search :tags="{{ $tags }}"></filtered-search>--}}

                            <div class="heading">
                                <h3>Newest Additions</h3>
                            </div>

                            <div id="additions" class="content py-0 rounded">
                                @foreach (app('listings')->filterSort('created_at')->take(8) as $listing)
                                    <div class="microcard" style="{{ $loop->last ? null : 'border-bottom: 1px dashed #e3e3e3;' }}">
                                        <div class="information d-flex flex-row py-3">
                                            <div class="icon text-green align-self-center mr-3">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="details flex-grow-1">
                                                <h3 class="mb-0 tw-text-grey-darkest tw-text-xs">{{ $listing->name }}</h3>
                                                <p class="tw-text-grey-dark tw-text-xs">Created {{ $listing->created_at->format('dS F Y') }}</p>
                                            </div>
                                            <div class="buttons w-25 d-flex align-items-center justify-content-end">
                                                <at-button type="info">Visit <i class="icon icon-arrow-right"></i></at-button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="social content shadow-inner bg-transparent p-3 tw-text-grey tw-text-4xl d-flex text-center">
                                <div class="tw-flex-1">
                                    <i class="fab fa-facebook"></i>
                                </div>
                                <div class="tw-flex-1">
                                    <i class="fab fa-reddit"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-8 py-5">
                        <transition name="fade" mode="out-in">
                            <div class="mb-3 server-card item flex-fill shadow border rounded">
                                <div class="server-card-head image rounded-top" style='height:350px; background-image: url("{{ $listing->banner_url }}")'></div>
                                <div class="server-card-head overlap d-flex" style="margin-top:-169px;">
                                    <i class="fas fa-arrow-left tw-text-white tw-text-2xl tw-absolute tw-align-top"></i>
                                    <div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
                                        <h1 class="text-white font-weight-bold mb-0" style="font-size: 24px;">{{ $listing->name }}</h1>
                                        <ul class="tag-list list-unstyled d-flex tw-text-xs tw-text-green-light">
                                            @foreach($listing->tags as $tag)
                                                <li class="mr-2">#{{ $tag->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
                                        <div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
                                            <h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
                                            <span class="card-counter font-weight-bold transparency">{{ $listing->votes_count }}</span>
                                        </div>
                                        <div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
                                            <h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
                                            <span class="card-counter font-weight-bold transparency">{{ $listing->clicks_count }}</span>
                                        </div>
                                        <div class="d-flex flex-column justify-content-end" style="height:100%;">
                                            <img src="/img/flags/english.png" alt="EN">
                                        </div>
                                    </div>
                                </div>

                                <section class="content-block mt-4">
                                    <div class="container px-5 pt-4">
                                        <at-button v-if="!created_review" type="info" class="w-100 tw-font-bold">Create a review for this server!</at-button>
                                    </div>
                                </section>

                                <section v-if="!creating_review" id="description" class="content-block mt-4">
                                    <div class="container px-5 py-4">
                                        <h3 class="heading mb-4 text-dark heading-underline">Description</h3>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy.</p>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section v-if="!creating_review" id="configuration" class="content-block">
                                    <div class="container px-5 py-4">
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
                                                @include('listing.partial.config', ['name'=>'Instant Cast Stat', 'type' => 'stat',  'value' => $listing->configs['instant_cast_stat']])
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

                                <section v-if="!creating_review" id="ratings">
                                    <div class="container pl-5 pr-5">
                                        <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2);">
                                            <h3 class="heading mb-4 text-dark heading-underline">Balance Ratings</h3>
                                            <div class="row no-gutters">
                                                <scoreboards inline-template>
                                                    <div class="d-flex">
                                                        <scoreboard title="Donations" description="Non-Donators can compete with Donators." :score="avg_donation_score"></scoreboard>
                                                        <scoreboard title="Updates" description="Improvements made each update." :score="avg_update_score"></scoreboard>
                                                        <scoreboard title="Classes" description="Classes are balanced against other classes." :score="avg_class_score"></scoreboard>
                                                        <scoreboard title="Items" description="Item stats are fair and well thought out." :score="avg_item_score"></scoreboard>
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
                                                        <scoreboard title="Content" description="There is much to do and progress upon." :score="avg_content_score"></scoreboard>
                                                        <scoreboard title="Events" description="Rewards are good and events are regular." :score="avg_event_score"></scoreboard>
                                                    </div>
                                                </scoreboards></div>
                                        </div>
                                    </div>
                                </section>
                                <section v-if="!creating_review" id="previews">
                                    <div class="container px-5 pb-5">
                                        <h3 class="heading mb-4 text-dark heading-underline">Screenshot Previews</h3>
                                        <div class="mb-3">
                                            Screenshots
                                        </div>
                                    </div>
                                </section>

                                <section id="reviews">
                                    <div class="container pl-5 pr-5 pb-5 mb-5">
                                        <h3 v-if="!creating_review" class="heading mb-4 text-dark heading-underline">Player Reviews</h3>

                                        <reviews :data="{{ $listing->reviews->load('publisher') }}" policy="{{ auth()->check() && auth()->user()->can('review', $listing) }}"></reviews>

                                    </div>
                                </section>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </listing-profile>

@endsection