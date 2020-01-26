@extends('layouts.profile')

@section('meta_tags')
    <!-- Primary Meta Tags -->
    <title>{{ $listing->name }} Vote Dispatcher</title>
    <meta name="title" content="{{ $listing->name }} Vote Dispatcher">
    <meta name="description" content="Vote for {{ $listing->name }} and help to stand out">
    <meta name="keywords" content="vote,vote4points">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url($listing->route() . '/votes') }}">
    <meta property="og:title" content="{{ $listing->name }} Vote Dispatcher">
    <meta property="og:description" content="Vote for {{ $listing->name }} and help to stand out">
    <meta property="og:image" content="{{ \Illuminate\Support\Facades\Storage::url($listing->background) }}">
@endsection

@section('content')
    <section id="voting">
        <div class="row no-gutters">
            <div class="tw-w-full">
                <div class="tw-flex">
                    <div class="tw-flex-1">
                        <div class="tw-mb-4">
                            <h3 class="heading tw-font-bold tw-mb-2 heading-underline tw-tracking-tighter">Auditing</h3>
                            <p class="tw-mb-1"><i class="fas fa-file-signature"></i> Starting Date: <b>{{ $listing->created_at->diffForHumans() }}</b></p>
                            <p class="tw-mb-1"><i class="fas fa-award"></i> Ranking Position: <b>5 out of 43</b></p>
                            <p class="tw-mb-1"><i class="fas fa-vote-yea"></i> Lifetime Votes: <b>493</b></p>
                            <p class="tw-mb-1"><i class="far fa-hand-pointer"></i> Lifetime Clicks: <b>234</b></p>
                            <p class="tw-mb-1"><i class="fas fa-glasses"></i> Lifetime Reviews: <b>14</b></p>
                            <p class="tw-mb-1"><i class="fas fa-coins"></i> Coins Generated: <b>23</b></p>
                        </div>
                    </div>
                    <div class="tw-flex-1">
                        <div class="tw-mb-4">
                            <h3 class="heading tw-font-bold tw-mb-2 heading-underline tw-tracking-tighter">Health Check</h3>
                            <div class="tw-flex tw-mb-4 tw-items-center">
                                <i class="fas fa-check-circle tw-mr-2" style="color:#84d05a"></i>
                                <div class="">
                                    <h5 class="tw-mb-0" style="font-size:14px;">Visibility Status</h5>
                                    <p>Your listing is <span class="tw-font-bold">Online</span></p>
                                </div>
                            </div>
                            <div class="tw-flex tw-mb-4 tw-items-center">
                                <i class="fas fa-check-circle tw-mr-2" style="color:#84d05a"></i>
                                <div class="">
                                    <h5 class="tw-mb-0" style="font-size:14px;">Heartbeat Status</h5>
                                    <p>Last received data: <b>xxx-xxx-xxx</b></p>
                                </div>
                            </div>
                            <div class="tw-flex tw-mb-4 tw-items-center">
                                <i class="fas fa-check-circle tw-mr-2" style="color:#84d05a"></i>
                                <div class="">
                                    <h5 class="tw-mb-0" style="font-size:14px;">Website Status</h5>
                                    <p>Last received data: <b>xxx-xxx-xxx</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="tw-mb-4">
                        <h3 class="heading tw-font-bold tw-mb-2 heading-underline tw-tracking-tighter">Population Metrics</h3>
                        <p class="tw-font-bold">Population metrics allow you to view when players are most active on the server</p>
                        <ul class="tw-text-xs tw-list-disc">
                            <li>Use the graph help judge the best time for in game events to take place</li>
                        </ul>
                    </div>
                    <population-metric-chart intersect="true" :height="200" url="{{ route('metric.players.averages', $listing) }}"></population-metric-chart>
                </div>
                <div class="">
                    <div class="tw-mb-4">
                        <h3 class="heading tw-font-bold tw-mb-2 heading-underline tw-tracking-tighter">Listing Votes Last 30 Days</h3>
                        <p class="tw-font-bold">Votes help you rise to the top and stand out, by gaining support of your players.</p>
                        <ul class="tw-text-xs tw-list-disc">
                            <li>Use a vote for points module on your website and connect with us</li>
                            <li>Use incentives for your players to vote more (gain 500 votes for 2x exp in game)</li>
                        </ul>
                    </div>
                    <monthly-vote-metric-chart :height="200" url="{{ route('metric.votes.monthly', $listing) }}"></monthly-vote-metric-chart>
                </div>
                <div class="">
                    <div class="tw-mb-4">
                        <h3 class="heading tw-font-bold tw-mb-2 heading-underline tw-tracking-tighter">Listing Clicks Last 30 Days</h3>
                        <p class="tw-font-bold">Clicks are the players that found interest on your page by browsing ragnaranks.com.</p>
                        <ul class="tw-text-xs tw-list-disc">
                            <li>Visitors are more likely to click into listings with styling and images</li>
                        </ul>
                    </div>
                    <monthly-click-metric-chart :height="200" url="{{ route('metric.clicks.monthly', $listing) }}"></monthly-click-metric-chart>
                </div>
            </div>
        </div>
    </section>
@endsection
