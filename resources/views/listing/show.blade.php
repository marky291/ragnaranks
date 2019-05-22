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
                                <span v-if="!theCurrentViewIs('voting')">
                                    <at-button @click="setView('voting')" class="w-100 mb-2" hollow>Vote for server</at-button>
                                </span>
                                <span v-else>
                                    <at-button @click="setView('listing')" type="error" class="w-100 mb-2" hollow>Back to Listing</at-button>
                                </span>
                                <span v-if="!theCurrentViewIs('reviewing')">
                                    <at-button @click="setView('reviewing')" type="success" class="w-100" hollow>Create a review</at-button>
                                </span>
                                <span v-else>
                                    <at-button @click="setView('listing')" type="error" class="w-100" hollow>Back to Listing</at-button>
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

                                <span v-if="theCurrentViewIs('listing')">
                                    @component('listing.partial.wrapper', ['view' => 'description', 'heading' => 'Description'])
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy.</p>
                                    @endcomponent
                                </span>

                                <section v-if="theCurrentViewIs('listing')" id="previews">
                                    <div class="container px-5 pt-4 pb-3">
                                        <h3 class="heading mb-4 tw-font-bold text-dark heading-underline">Screenshot Previews</h3>
                                        <div class="mb-3">
                                            <carousel-3d :disable3d="true" :space="360" :height="200" :width="350" :autoplay="true" :autoplay-timeout="5000" :controls-visible="true"  :controls-width="30" :controls-height="60" :clickable="false">
                                                @foreach($listing->screenshots as $index => $screenshot)
                                                    <slide :index="{{ $index }}">
                                                        <img class="h-100" src="{{ $screenshot->link }}" alt="Image {{ $index }}">
                                                    </slide>
                                                @endforeach
                                            </carousel-3d>
                                        </div>
                                    </div>
                                </section>

                                <section v-if="theCurrentViewIs('listing')" id="ratings">
                                    <div class="container pl-5 pr-5">
                                        <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2);">
                                            <h3 class="heading mb-4 tw-font-bold text-dark heading-underline">Balance Ratings</h3>
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
                                            <h3 class="heading mb-4 tw-font-bold text-dark heading-underline">Server Ratings</h3>
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
                                        <h3 v-if="theCurrentViewIs('listing')" class="heading mb-4 tw-font-bold text-dark heading-underline">Player Reviews</h3>

                                        <reviews :data="{{ $listing->reviews->load('publisher') }}" inline-template>
                                            <div class="">
                                                <div v-if="$parent.theCurrentViewIs('listing')" v-for="(review, index) in collection">
                                                    <review :review="review" inline-template>
                                                        <div class="review tw-mb-4 tw-p-3">
                                                            <div class="row no-gutters">
                                                                <div class="col bg-white pb-3 content">
                                                                    <div class="tw-flex mb-3 tw-items-center">
                                                                        <div class="tw-rounded-full tw-h-16 tw-w-16 tw-flex tw-avatar-circle tw-items-center tw-justify-center tw-mr-3 tw-bg-grey">
                                                                            <img class="border hover:tw-border-solid hover:tw-border-grey hover:tw-shadow tw-rounded-full tw-avatar-circle" :src="review.publisher.avatarUrl" alt="">
                                                                        </div>
                                                                        <div class="tw-flex tw-flex-row tw-flex-1 tw-text-left">
                                                                            <div class="info d-flex tw-flex-col tw-flex mb-1">
                                                                                <p class="tw-flex-1 tw-text-lg tw-text-grey-darkest tw-font-semibold tw-mb-0">@{{ review.publisher.username }}</p>
                                                                                <p>Member since @{{ memberSinceDate() }}</p>
                                                                            </div>
                                                                            <div class="tw-flex tw-flex-col tw-text-right tw-flex-1">
                                                                                Rating: @{{ averageRating }} (@{{ averageScore }})
                                                                                <p class="tw-flex-1">Posted @{{ formattedDate() }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="description">
                                                                        <p class="tw-text-grey-dark">@{{ review.message }}</p>
                                                                    </div>
                                                                    <div class="tw-border-red tw-p-2 tw-mt-2 tw-bg-red-lightest tw-rounded" v-for="(comment, index) in review.comments">
                                                                        <p class="tw-font-semibold">Reply from owner</p>
                                                                        <p class="tw-text-red">@{{ comment.message }}</p>
                                                                    </div>
                                                                    <div v-show="viewingDetails" class="tw-flex tw-border-t tw-border-grey-light py-3 mt-3">
                                                                        <ul class="tw-flex-1 mb-0">
                                                                            <li class="tw-text-xs"><b>Donation Score</b>: @{{ review.donation_score }}</li>
                                                                            <li class="tw-text-xs"><b>Update Score</b>: @{{ review.update_score }}</li>
                                                                        </ul>
                                                                        <ul class="tw-flex-1 mb-0">
                                                                            <li class="tw-text-xs"><b>Classes Score</b>: @{{ review.class_score }}</li>
                                                                            <li class="tw-text-xs"><b>Items Score</b>: @{{ review.item_score }}</li>
                                                                        </ul>
                                                                        <ul class="tw-flex-1 mb-0">
                                                                            <li class="tw-text-xs"><b>Support Score</b>: @{{ review.support_score }}</li>
                                                                            <li class="tw-text-xs"><b>Hosting Score</b>: @{{ review.hosting_score }}</li>
                                                                        </ul>
                                                                        <ul class="tw-flex-1 mb-0">
                                                                            <li class="tw-text-xs"><b>Content Score</b>: @{{ review.content_score }}</li>
                                                                            <li class="tw-text-xs"><b>Events Score</b>: @{{ review.event_score }}</li>
                                                                        </ul>
                                                                    </div>
                                                                    <div v-show="commenting" class="tw-mt-3">
                                                                        <p class="tw-text-red tw-font-semibold">Comment on this review as server owner</p>
                                                                        <at-textarea v-model="comment.message" min-rows="5" class="tw-mt-2" autosize placeholder="Write your reply towards this review"></at-textarea>
                                                                        <has-error :form="comment" field="message"></has-error>
                                                                        <at-button @click="postComment" type="error" class="tw-mt-2">Post Comment</at-button>
                                                                    </div>
                                                                    <div class="tw-flex tw-justify-end">
                                                                        <at-button @click="viewingDetails = !viewingDetails" icon="icon-maximize-2" type="text">@{{ detailButtonText }}</at-button>
                                                                        <at-button @click="reportReview" icon="icon-flag" type="text">Report</at-button>
                                                                        <at-button v-if="!review.comments.length" @click="commenting = !commenting" icon="icon-paperclip" type="text">@{{ commentButtonText }}</at-button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </review>
                                                </div>

                                                <div v-if="$parent.theCurrentViewIs('reviewing')" @review-created="addReview" id="comment-reply" class="tw-mt-4 create-reply tw-flex tw-items-center rounded tw-cursor-pointer">
                                                    <div class="tw-p-4 tw-flex tw-w-full tw-items-center">
                                                        <span id="reply-action" class="tw-w-full">
                                                            <div class="row">
                                                                <div class="py-3">
                                                                    <h3 class="heading tw-mb-1 tw-font-bold text-dark mb-4 heading-underline">You are creating a <span class="tw-text-blue">Review</span></h3>
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
                                                            <at-button @click="$parent.setView('listing')" type="info" hollow>Maybe I will create one later!</at-button>
                                                            </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </reviews>

                                    </div>
                                </section>

                                <span v-if="theCurrentViewIs('voting')">
                                    @component('listing.partial.wrapper', ['view' => 'voting','heading' => "You are voting for $listing->name"])
                                        <p class="tw-font-bold mb-3 tw-text-green">You have (1) vote remaining!</p>
                                        <p class="mb-3">Your vote will have a cooling period of <b>{{ config('interaction.vote.spread') }} hours</b>, this cannot be returned and will remain on {{ $listing->name }} for 7 days starting from the time and date of your cast</p>
                                        <at-button type="primary" icon="icon-log-out" class="mt-2">Vote for {{ $listing->name }}</at-button>
                                    @endcomponent
                                </span>

                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </listing-profile>

@endsection