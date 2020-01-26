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
                <div class="">
                    <div class="tw-mb-4">
                        <h3 class="heading tw-font-bold tw-mb-2 heading-underline tw-tracking-tighter">Population Metrics</h3>
                        <p>Population metrics allow you to view when players are most active on the server</p>
                    </div>
                    <population-metric-chart intersect="true" :height="200" url="{{ route('metric.players.averages', $listing) }}"></population-metric-chart>
                </div>
                <div class="">
                    <div class="tw-mb-4">
                        <h3 class="heading tw-font-bold tw-mb-2 heading-underline tw-tracking-tighter">Listing Date</h3>
                        <p>You let us help your journey </p>
                    </div>
                    <p class="tw-font-bold">{{ $listing->created_at->diffForHumans() }}</p>
                </div>
                <div class="">
                    <div class="tw-mb-4">
                        <h3 class="heading tw-font-bold tw-mb-2 heading-underline tw-tracking-tighter">Monthly Server Votes</h3>
                        <p>Votes help you rise to the top and stand out, by gaining support of your players.</p>
                        <ul>
                            <li>Use a vote for points module on your website and connect with us</li>
                            <li>Use incentives for your players to vote more (gain 500 votes for 2x exp in game)</li>
                        </ul>
                    </div>
                    <monthly-vote-metric-chart :height="200" url="{{ route('metric.votes.monthly', $listing) }}"></monthly-vote-metric-chart>
                </div>
            </div>
        </div>
    </section>
@endsection
