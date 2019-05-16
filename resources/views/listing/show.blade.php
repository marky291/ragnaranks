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
                        @component('layouts.sidebar')
                            <div class="heading">
                                <h3>User Actions</h3>
                            </div>
                            <div id="user-actions" class="content py-0 rounded py-3 d-flex flex-column">
                                <at-button class="mb-2" type="primary" hollow>Back to Searching</at-button>
                                <at-button class="mb-2" hollow>Visit Website</at-button>
                                <at-button class="mb-2" hollow>Vote for Server</at-button>
                                <span v-if="!creating_review">
                                    <at-button v-if="!creating_review" @click="toggleReview" type="success" class="w-100" hollow>Create a review!</at-button>
                                </span>
                                <span v-else>
                                    <at-button @click="toggleReview" type="error" class="w-100" hollow>Review Later!</at-button>
                                </span>
                            </div>
                        @endcomponent
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

                                <section v-if="!creating_review" id="previews">
                                    <div class="container px-5 pt-4 pb-3">
                                        <h3 class="heading mb-4 text-dark heading-underline">Screenshot Previews</h3>
                                        <div class="mb-3">
                                            <carousel-3d :disable3d="true" :space="360" :height="200" :width="350" :autoplay="true" :autoplay-timeout="5000" :controls-visible="true"  :controls-width="30" :controls-height="60" :clickable="false">
                                                @for ($i = 0; $i < 7; $i++)
                                                    <slide :index="{{ $i }}">
                                                        <img class="h-100" src="https://o.aolcdn.com/images/dims?quality=85&image_uri=http%3A%2F%2Fwww.blogcdn.com%2Fmassively.joystiq.com%2Fmedia%2F2011%2F04%2Frag.jpg&client=amp-blogside-v2&signature=3b85eeb6a08455faef2f40eaf515cabd0402d20b" alt="Image {{ $i }}">
                                                    </slide>
                                                @endfor
                                            </carousel-3d>
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
                                <section id="reviews">
                                    <div class="container px-5 py-4">
                                        <h3 v-if="!creating_review" class="heading mb-4 text-dark heading-underline">Player Reviews</h3>

                                        <reviews :data="{{ $listing->reviews->load('publisher') }}" policy="{{ auth()->check() && auth()->user()->can('review', $listing) }}" inline-template>
                                            <div class="">
                                                <div v-if="!isCreatingReview" v-for="(review, index) in collection">
                                                    <review :data="review"></review>
                                                </div>

                                                <div v-if="reviewable" @review-created="addReview" id="comment-reply" class="tw-mt-4 create-reply tw-flex tw-items-center rounded tw-cursor-pointer">
                                                    <div class="tw-p-4 tw-flex tw-w-full tw-items-center">
                                                        <span v-if="isCreatingReview" id="reply-action" class="tw-w-full">
                                                            <div class="row">
                                                                <div class="py-3">
                                                                    <h3 class="heading tw-mb-1 text-dark mb-4 heading-underline">You are creating a <span class="tw-text-blue">Review</span></h3>
                                                                    <p class="tw-text-grey-dark mb-4">Focus on being factual and objective. Don't use aggressive language and don't post personal details...</p>
                                                                    <at-textarea ref="textarea" v-model="form.review_input" min-rows="8" autosize placeholder="Your experience, Your review"></at-textarea>
                                                                </div>
                                                                <div class="row tw-mb-5">
                                                                    <div class="col-6">
                                                                        <div class="tw-p-2 tw-rounded tw-mb-4">
                                                                            <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Donation Experience</p>
                                                                            <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                                                            <at-rate :show-text="true" :count="5" v-model="form.donation_score" class="tw-flex">
                                                                                <p class="tw-font-bold">@{{ ratingScore(form.donation_score) }}</p>
                                                                            </at-rate>
                                                                        </div>

                                                                        <div class="tw-p-2 tw-rounded tw-mb-4">
                                                                            <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Update Experience</p>
                                                                            <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">Are updates regular with positive effect on the server</p>
                                                                            <at-rate :show-text="true" :count="5" v-model="form.update_score" class="tw-flex">
                                                                                <p class="tw-font-bold">@{{ ratingScore(form.update_score) }}</p>
                                                                            </at-rate>
                                                                        </div>

                                                                        <div class="tw-p-2 tw-rounded tw-mb-4">
                                                                            <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Class Experience</p>
                                                                            <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                                                            <at-rate :show-text="true" :count="5" v-model="form.class_score" class="tw-flex">
                                                                                <p class="tw-font-bold">@{{ ratingScore(form.class_score) }}</p>
                                                                            </at-rate>
                                                                        </div>

                                                                        <div class="tw-p-2 tw-rounded tw-mb-4">
                                                                            <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Item Experience</p>
                                                                            <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                                                            <at-rate :show-text="true" :count="5" v-model="form.item_score" class="tw-flex">
                                                                                <p class="tw-font-bold">@{{ ratingScore(form.item_score) }}</p>
                                                                            </at-rate>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">

                                                                        <div class="tw-p-2 tw-rounded tw-mb-4">
                                                                            <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Support Experience</p>
                                                                            <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                                                            <at-rate :show-text="true" :count="5" v-model="form.support_score" class="tw-flex">
                                                                                <p class="tw-font-bold">@{{ ratingScore(form.support_score) }}</p>
                                                                            </at-rate>
                                                                        </div>

                                                                        <div class="tw-p-2 tw-rounded tw-mb-4">
                                                                            <h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Hosting Experience</h4>
                                                                            <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                                                            <at-rate :show-text="true" :count="5" v-model="form.hosting_score" class="tw-flex">
                                                                                <p class="tw-font-bold">@{{ ratingScore(form.hosting_score) }}</p>
                                                                            </at-rate>
                                                                        </div>

                                                                        <div class="tw-p-2 tw-rounded tw-mb-4">
                                                                            <h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Content Experience</h4>
                                                                            <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                                                            <at-rate :show-text="true" :count="5" v-model="form.content_score" class="tw-flex">
                                                                                <p class="tw-font-bold">@{{ ratingScore(form.content_score) }}</p>
                                                                            </at-rate>
                                                                        </div>

                                                                        <div class="tw-p-2 tw-rounded tw-mb-4">
                                                                            <h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Event Experience</h4>
                                                                            <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                                                            <at-rate :show-text="true" :count="5" v-model="form.event_score" class="tw-flex">
                                                                                <p class="tw-font-bold">@{{ ratingScore(form.event_score) }}</p>
                                                                            </at-rate>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <at-button type="primary" class="flex-fill">Post my Review!</at-button>
                                                            <at-button @click="changeReviewState" type="info" hollow>Maybe I will create one later!</at-button>
                                                            </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </reviews>

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