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
                <div class="tw-mb-4">
                    <h3 class="heading tw-font-bold tw-mb-2 heading-underline tw-tracking-tighter">Population Metrics</h3>
                    <p>Population metrics allow you to view when players are most active on the server</p>
                </div>
                <population-metric-chart intersect="true" :height="200" url="{{ route('metric.players.today', $listing) }}"></population-metric-chart>
            </div>
        </div>
    </section>
@endsection
